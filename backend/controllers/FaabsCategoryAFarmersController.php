<?php

namespace backend\controllers;

use Yii;
use backend\models\MeFaabsCategoryAFarmers;
use backend\models\MeFaabsCategoryAFarmersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;

/**
 * FaabsCategoryAFarmersController implements the CRUD actions for MeFaabsCategoryAFarmers model.
 */
class FaabsCategoryAFarmersController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'delete', 'view', 'update'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete', 'view', 'update'],
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
     * Lists all MeFaabsCategoryAFarmers models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Manage category A farmers') || User::userIsAllowedTo('View category A farmers')) {
            $searchModel = new MeFaabsCategoryAFarmersSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            if (!empty(Yii::$app->request->queryParams['MeFaabsCategoryAFarmersSearch']['province_id'])) {
                $district_ids = [];
                $districts = \backend\models\Districts::find()->where(['province_id' => Yii::$app->request->queryParams['MeFaabsCategoryAFarmersSearch']['province_id']])->all();
                if (!empty($districts)) {
                    foreach ($districts as $id) {
                        array_push($district_ids, $id['id']);
                    }
                } else {
                    $_ids = [''];
                }

                $_camp_ids = [];
                $_faabs_ids = [-1];
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(["IN", 'district_id', $district_ids])
                        ->asArray()
                        ->all();

                //   var_dump($camp_ids);
                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                    $list = \backend\models\MeFaabsGroups::find()
                            ->where(['IN', 'camp_id', $_camp_ids])
                            ->all();
                    if (!empty($list)) {
                        foreach ($list as $id) {
                            array_push($_faabs_ids, $id['id']);
                        }
                    }
                }
                $dataProvider->query->andFilterWhere(['IN', 'faabs_group_id', $_faabs_ids]);
            }


            if (!empty(Yii::$app->request->queryParams['MeFaabsCategoryAFarmersSearch']['district_id'])) {

                $_camp_ids = [];
                $_faabs_ids = [-1];
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(['district_id' => Yii::$app->request->queryParams['MeFaabsCategoryAFarmersSearch']['district_id']])
                        ->asArray()
                        ->all();

                //   var_dump($camp_ids);
                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                    $list = \backend\models\MeFaabsGroups::find()
                            ->where(['IN', 'camp_id', $_camp_ids])
                            ->all();
                    if (!empty($list)) {
                        foreach ($list as $id) {
                            array_push($_faabs_ids, $id['id']);
                        }
                    }
                }
                $dataProvider->query->andFilterWhere(['IN', 'faabs_group_id', $_faabs_ids]);
            }

            if (!empty(Yii::$app->request->queryParams['MeFaabsCategoryAFarmersSearch']['camp_id'])) {

                $_faabs_ids = [-1];

                $list = \backend\models\MeFaabsGroups::find()
                        ->where(['camp_id' => Yii::$app->request->queryParams['MeFaabsCategoryAFarmersSearch']['camp_id']])
                        ->all();

                if (!empty($list)) {
                    foreach ($list as $id) {
                        array_push($_faabs_ids, $id['id']);
                    }
                }

                $dataProvider->query->andFilterWhere(['IN', 'faabs_group_id', $_faabs_ids]);
            }

            if (!empty(Yii::$app->user->identity->district_id) && Yii::$app->user->identity->district_id > 0) {
                $_camp_ids = [];
                $_faabs_ids = [];
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(['district_id' => Yii::$app->user->identity->district_id])
                        ->asArray()
                        ->all();
                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                    $list = \backend\models\MeFaabsGroups::find()
                            ->where(['IN', 'camp_id', $_camp_ids])
                            ->orderBy(['name' => SORT_ASC])
                            ->all();
                    if (!empty($list)) {
                        foreach ($list as $id) {
                            array_push($_faabs_ids, $id['id']);
                        }
                    }
                }
                $dataProvider->query->andFilterWhere(['IN', 'faabs_group_id', $_faabs_ids]);
            }
            if (Yii::$app->request->post('hasEditable')) {
                $Id = Yii::$app->request->post('editableKey');
                $model = MeFaabsCategoryAFarmers::findOne($Id);
                $out = Json::encode(['output' => '', 'message' => '']);
                $posted = current($_POST['MeFaabsCategoryAFarmers']);
                $post = ['MeFaabsCategoryAFarmers' => $posted];

                if ($model->load($post)) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated Category A Farmer details";
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    $model->updated_by = Yii::$app->user->id;

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

            $dataProvider->pagination = ['pageSize' => 15];
            $dataProvider->setSort([
                'attributes' => [
                    'created_at' => [
                        'desc' => ['created_at' => SORT_DESC],
                        'default' => SORT_DESC
                    ],
                ],
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ]);
            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Displays a single MeFaabsCategoryAFarmers model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (User::userIsAllowedTo('Manage category A farmers') || User::userIsAllowedTo('View category A farmers')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Creates a new MeFaabsCategoryAFarmers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Manage category A farmers')) {

            $model = new MeFaabsCategoryAFarmers();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }
            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->status = 1;
                $date1 = new \DateTime($model->dob);
                $date2 = new \DateTime(date("Y-m-d"));
                $model->age = (int) \date_diff($date2, $date1)->y;

                if ($model->save()) {
                    $name = $model->first_name . " " . $model->other_names . " " . $model->last_name;
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added farmer: " . $name;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Farmer: ' . $name . ' was successfully added.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while adding Farmer ' . $name);
                }
            }

            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Updates an existing MeFaabsCategoryAFarmers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (User::userIsAllowedTo('Manage category A farmers')) {
            $model = $this->findModel($id);
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->updated_by = Yii::$app->user->identity->id;
                $date1 = new \DateTime($model->dob);
                $date2 = new \DateTime(date("Y-m-d"));
                $model->age = (int) \date_diff($date2, $date1)->y;

                if ($model->save()) {
                    $name = $model->first_name . " " . $model->other_names . " " . $model->last_name;
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated farmer records for farmer: " . $name;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Farmers records were successfully updated.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while updating Farmer records');
                }
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Deletes an existing MeFaabsCategoryAFarmers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Remove category A farmers')) {
            $model = $this->findModel($id);
            $name = $model->first_name . " " . $model->other_names . " " . $model->last_name;
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed farmer:$name from the system.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "Farmer: $name was successfully removed from the system.");
            } else {
                Yii::$app->session->setFlash('error', "Farmer: $name could not be removed. Please try again!");
            }

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the MeFaabsCategoryAFarmers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeFaabsCategoryAFarmers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MeFaabsCategoryAFarmers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
