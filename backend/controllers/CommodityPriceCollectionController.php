<?php

namespace backend\controllers;

use Yii;
use backend\models\CommodityPriceCollection;
use backend\models\CommodityPriceCollectionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;
use yii\base\Model;
use yii\caching\DbDependency;
/**
 * CommodityPriceCollectionController implements the CRUD actions for CommodityPriceCollection model.
 */
class CommodityPriceCollectionController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'delete',],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CommodityPriceCollection models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Collect commodity prices') || User::userIsAllowedTo("View commodity prices")) {
            $model = new CommodityPriceCollection();
            $searchModel = new CommodityPriceCollectionSearch();
           // $prices_dependency = new DbDependency();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->pagination = ['pageSize' => 10];
            if (!empty(Yii::$app->request->queryParams['CommodityPriceCollectionSearch']['province_id'])) {
                $district_ids = [];
                $districts = \backend\models\Districts::find()->where(['province_id' => Yii::$app->request->queryParams['CommodityPriceCollectionSearch']['province_id']])->all();
                if (!empty($districts)) {
                    foreach ($districts as $id) {
                        array_push($district_ids, $id['id']);
                    }
                } else {
                    $_ids = [''];
                }

                $dataProvider->query->andFilterWhere(['IN', 'district', $district_ids]);
            }
            if (Yii::$app->getUser()->identity->district_id > 0) {
                $dataProvider->query->andFilterWhere(['district' => Yii::$app->getUser()->identity->district_id]);
                if (Yii::$app->request->post('hasEditable')) {
                    $Id = Yii::$app->request->post('editableKey');
                    $model = CommodityPriceCollection::findOne($Id);
                    $out = Json::encode(['output' => '', 'message' => '']);
                    $posted = current($_POST['CommodityPriceCollection']);
                    $post = ['CommodityPriceCollection' => $posted];

                    if ($model->load($post)) {
                        $audit = new AuditTrail();
                        $audit->user = Yii::$app->user->id;
                        $audit->action = "Updated commodity price details";
                        $audit->ip_address = Yii::$app->request->getUserIP();
                        $audit->user_agent = Yii::$app->request->getUserAgent();
                        $audit->save();
                        $model->updated_by = Yii::$app->user->id;
                        $model->price = str_replace("-", "", $model->price);
                        $message = '';
                        if (!$model->save()) {
                            foreach ($model->getErrors() as $error) {
                                $message .= $error[0];
                            }
                            $output = $message;
                        }
                        $output = '';
                        $out = Json::encode(['output' => $output, 'message' => $message]);
                    }
                    return $out;
                }
                $dataProvider->query->andFilterWhere(['created_by' => Yii::$app->user->id]);
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'model' => $model,
                            'dataProvider' => $dataProvider,
                ]);
            } else {

                return $this->render('view-prices', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Displays a single CommodityPriceCollection model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CommodityPriceCollection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Collect commodity prices')) {
            $model = new CommodityPriceCollection();
            $modelForm = [new CommodityPriceCollection()];
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if (!empty(Yii::$app->request->post())) {
                $modelForm = \backend\models\Model::createMultiple(CommodityPriceCollection::classname());
                $count = 0;
                $errors = '';
                if (Model::loadMultiple($modelForm, Yii::$app->request->post())) {
                    //  $province_id = backend\models\Districts::findOne([Yii::$app->getUser()->identity->district_id])->province_id;
                    $transaction = \Yii::$app->db->beginTransaction();
                    try {
                        foreach ($modelForm as $Model) {
                            $Model->updated_by = Yii::$app->user->identity->id;
                            $Model->created_by = Yii::$app->user->identity->id;
                            $Model->district = Yii::$app->getUser()->identity->district_id;
                            $count++;
                            if (!($flag = $Model->save())) {
                                $transaction->rollBack();
                                foreach ($Model->getErrors() as $error) {
                                    $errors .= "\n" . $error[0];
                                }
                                break;
                            }
                        }

                        if ($flag) {
                            $transaction->commit();
                            $audit = new AuditTrail();
                            $audit->user = Yii::$app->user->id;
                            $audit->action = "Added $count commodity prices";
                            $audit->ip_address = Yii::$app->request->getUserIP();
                            $audit->user_agent = Yii::$app->request->getUserAgent();
                            $audit->save();
                            Yii::$app->session->setFlash('success', 'You have successfully added ' . $count . ' commodity price records.');
                            return $this->redirect(['index']);
                        }
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('error', 'Error occured while saving commodity price records.' . $ex->getMessage() . ' Please try again1');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while saving commodity price records. Please try again2');
                }
            }

            return $this->render('create', [
                        'model' => $model,
                        'modelForm' => $modelForm,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Updates an existing CommodityPriceCollection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CommodityPriceCollection model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Remove commodity price')) {
            $model = $this->findModel($id);
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed commodity price from the system.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Commodity price was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "Commodity price could not be removed. Please try again!");
            }
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the CommodityPriceCollection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CommodityPriceCollection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CommodityPriceCollection::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
