<?php

namespace backend\controllers;

use Yii;
use backend\models\MeFaabsGroups;
use backend\models\MeFaabsGroupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;

/**
 * FaabsGroupsController implements the CRUD actions for MeFaabsGroups model.
 */
class FaabsGroupsController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'delete', 'faabs-by-camp', 'farmers'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'delete', 'faabs-by-camp', 'farmers'],
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
     * Lists all MeFaabsGroups models.
     * @return mixed
     */
    public function actionIndex() {
        if (User::userIsAllowedTo('Manage faabs groups') || User::userIsAllowedTo('View faabs groups')) {
            $model = new MeFaabsGroups();
            $searchModel = new MeFaabsGroupsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            if (!empty(Yii::$app->request->queryParams['MeFaabsGroupsSearch']['province_id'])) {
                $district_ids = [];
                $districts = \backend\models\Districts::find()->where(['province_id' => Yii::$app->request->queryParams['MeFaabsGroupsSearch']['province_id']])->all();
                if (!empty($districts)) {
                    foreach ($districts as $id) {
                        array_push($district_ids, $id['id']);
                    }
                } else {
                    $_ids = [''];
                }

                $_camp_ids = [-1];
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(["IN", 'district_id', $district_ids])
                        ->asArray()
                        ->all();

                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                }
                $dataProvider->query->andFilterWhere(['IN', 'camp_id', $_camp_ids]);
            }


            if (!empty(Yii::$app->request->queryParams['MeFaabsGroupsSearch']['district_id'])) {

                $_camp_ids = [-1];
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(['district_id' => Yii::$app->request->queryParams['MeFaabsGroupsSearch']['district_id']])
                        ->asArray()
                        ->all();

                //   var_dump($camp_ids);
                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                }
                $dataProvider->query->andFilterWhere(['IN', 'camp_id', $_camp_ids]);
            }


            if (!empty(Yii::$app->user->identity->district_id) && Yii::$app->user->identity->district_id > 0) {
                $_camp_ids = [];
                $camp_ids = \backend\models\Camps::find()
                        ->select(['id'])
                        ->where(['district_id' => Yii::$app->user->identity->district_id])
                        ->asArray()
                        ->all();
                if (!empty($camp_ids)) {
                    foreach ($camp_ids as $id) {
                        array_push($_camp_ids, $id['id']);
                    }
                }
                $dataProvider->query->andFilterWhere(['IN', 'camp_id', $_camp_ids]);
            }

            if (Yii::$app->request->post('hasEditable')) {
                $Id = Yii::$app->request->post('editableKey');
                $model = MeFaabsGroups::findOne($Id);
                $out = Json::encode(['output' => '', 'message' => '']);
                $posted = current($_POST['MeFaabsGroups']);
                $post = ['MeFaabsGroups' => $posted];

                if ($model->load($post)) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated FaaBS group details";
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
                        'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Displays a single MeFaabsGroups model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (User::userIsAllowedTo('Manage faabs groups')|| User::userIsAllowedTo('View faabs groups')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    public function actionAddTopics($id) {
        $model = new \backend\models\MeFaabsTrainingTopicEnrolment();
        if ($model->load(Yii::$app->request->post())) {

            $count = 0;
            foreach ($model->topics as $topic) {
                $_model = new \backend\models\MeFaabsTrainingTopicEnrolment();
                $_model->faabs_id = $id;
                $_model->training_type = $model->training_type;
                $_model->topic_id = $topic;
                $_model->topics = "topics";
                // $rightAllocation->created_by = Yii::$app->user->id;
                if ($_model->save()) {
                    $count++;
                }
            }
            if ($count > 0) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Added training topics to FaaBS group:" . MeFaabsGroups::findOne($id)->name;
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', 'Training topics were successfully added to FaaBS group.');
            } else {
                Yii::$app->session->setFlash('error', 'Training topics could not be added to FaaBS group.');
            }
            return $this->redirect(['view', 'id' => $id]);
        }
    }

    public function actionUpdateTopics($id) {
        $model = new \backend\models\MeFaabsTrainingTopicEnrolment();



        if ($model->load(Yii::$app->request->post())) {
            $_model = new \backend\models\MeFaabsTrainingTopicEnrolment();
            $_model::deleteAll(['faabs_id' => $id]);
            $count = 0;

            foreach ($model->topics as $topic) {
                $_model->id = NULL; //primary key(auto increment id) id
                $_model->isNewRecord = true;
                $_model->faabs_id = $id;
                $_model->training_type = $model->training_type;
                $_model->topic_id = $topic;
                $_model->topics = "topics";
                if ($_model->save()) {
                    $count++;
                }
            }

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                if ($count > 0) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Updated training topics for FaaBS group:" . MeFaabsGroups::findOne($id)->name;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'Training topics were successfully updated for FaaBS group.');
                } else {
                    Yii::$app->session->setFlash('error', 'Training topics could not be updated for FaaBS group.');
                }
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        $model->topics = \backend\models\MeFaabsTrainingTopicEnrolment::find()
                ->where(['faabs_id' => $id])
                ->all();
        $array = [];
        foreach ($model->topics as $topic => $v) {
            array_push($array, $v['topic_id']);
        }
        //var_dump($array);
        $model->training_type = \backend\models\MeFaabsTrainingTopicEnrolment::findOne(['faabs_id' => $id])->training_type;
        $model->faabs_id = $id;
        $model->topics = $array;
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update-topic-modal', [
                        'id' => $id,
                        'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new MeFaabsGroups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (User::userIsAllowedTo('Manage faabs groups')) {
            $model = new MeFaabsGroups();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                return Json::encode(\yii\widgets\ActiveForm::validate($model));
            }

            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->status = 1;
                if ($model->save()) {
                    $audit = new AuditTrail();
                    $audit->user = Yii::$app->user->id;
                    $audit->action = "Added FaaBS group " . $model->name;
                    $audit->ip_address = Yii::$app->request->getUserIP();
                    $audit->user_agent = Yii::$app->request->getUserAgent();
                    $audit->save();
                    Yii::$app->session->setFlash('success', 'FaaBS group: ' . $model->name . ' was successfully added. You can add training topics');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error occured while adding FaaBS group ' . $model->name);
                }
                return $this->redirect(['index']);
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
     * Updates an existing MeFaabsGroups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /* public function actionUpdate($id) {
      $model = $this->findModel($id);

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
      }

      return $this->render('update', [
      'model' => $model,
      ]);
      } */

    /**
     * Deletes an existing MeFaabsGroups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (User::userIsAllowedTo('Remove faabs groups')) {
            $model = $this->findModel($id);
            $name = $model->name;
            if ($model->delete()) {
                $audit = new AuditTrail();
                $audit->user = Yii::$app->user->id;
                $audit->action = "Removed FaaBS group $name from the system.";
                $audit->ip_address = Yii::$app->request->getUserIP();
                $audit->user_agent = Yii::$app->request->getUserAgent();
                $audit->save();
                Yii::$app->session->setFlash('success', "FaaBS group: $name was successfully removed.");
            } else {
                Yii::$app->session->setFlash('error', "FaaBS group: $name could not be removed. Please try again!");
            }

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/home']);
        }
    }

    /**
     * Finds the MeFaabsGroups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MeFaabsGroups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = MeFaabsGroups::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFaabsByCamp() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            // $selected_id = $_POST['depdrop_all_params']['selected_id3'];
            if ($parents != null) {
                $camp_id = $parents[0];
                $out = \backend\models\MeFaabsGroups::find()
                        ->select(['id', "name"])
                        // ->select(['id', "CONCAT(name,'-',code) as name"])
                        ->where(['camp_id' => $camp_id])
                        ->asArray()
                        ->all();

                return ['output' => $out, 'selected' => ""];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionFarmers() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        //\Yii::info("I CAN GET HERE");

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            $selected_id = $_POST['depdrop_all_params']['selected_id'];
            if ($parents != null) {
                $_id = $parents[0];
                $out = \backend\models\MeFaabsCategoryAFarmers::find()
                        ->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_names),' ',last_name) as name", 'id'])
                        ->where(['status' => 1])
                        ->andWhere(['IN', 'faabs_group_id', $_id])
                        ->orderBy(['id' => SORT_ASC])
                        ->asArray()
                        ->all();
                //\Yii::warning($out);
                return ['output' => $out, 'selected' => $selected_id];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionTopics() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


        if (isset($_POST['depdrop_parents'])) {

            $parents = $_POST['depdrop_parents'];
            $selected_id = $_POST['depdrop_all_params']['selected_id'];
            if ($parents != null) {
                //Lets get topics that a farmer has already been trained on
                $topic_ids = [];
                $topic_ids1 = [];
                $final_out = [];
                $farmer_trained_topics = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->where(['farmer_id' => $parents[0]])
                        ->andWhere(['faabs_group_id' => $parents[1]])
                        ->asArray()
                        ->all();
                //  \Yii::warning($farmer_trained_topics);

                $faabs_topics = \backend\models\MeFaabsTrainingTopicEnrolment::find()
                        ->where(['faabs_id' => $parents[1]])
                        ->asArray()
                        ->all();



                if (!empty($farmer_trained_topics)) {

                    foreach ($farmer_trained_topics as $trained_topic) {
                        array_push($topic_ids1, $trained_topic['topic']);
                    }

                    foreach ($faabs_topics as $topic) {
                        array_push($topic_ids, $topic['topic_id']);
                    }

                    //\Yii::warning($topic_ids);

                    $training_topics = \backend\models\MeFaabsTrainingTopics::find()
                            ->select(["CONCAT(category,' - ',topic) as name", 'id'])
                            ->where(['IN', 'id', $topic_ids])
                            ->orderBy(['id' => SORT_ASC])
                            ->asArray()
                            ->all();
                    foreach ($training_topics as $topics) {
                        if (!in_array($topics['id'], $topic_ids1)) {
                            $_arr = [
                                'id' => $topics['id'],
                                'name' => $topics['name']
                            ];
                            array_push($final_out, $_arr);
                        }
                    }

                    // \Yii::warning($final_out);
                    return ['output' => $final_out, 'selected' => $selected_id];
                } else {
                    if (!empty($faabs_topics)) {
                        foreach ($faabs_topics as $topic) {
                            array_push($topic_ids, $topic['topic_id']);
                        }

                        $out = \backend\models\MeFaabsTrainingTopics::find()
                                ->select(["CONCAT(category,' - ',topic) as name", 'id'])
                                ->where(['IN', 'id', $topic_ids])
                                ->orderBy(['id' => SORT_ASC])
                                ->asArray()
                                ->all();
                    }
                    return ['output' => $out, 'selected' => $selected_id];
                }
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionTopicss() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


        if (isset($_POST['depdrop_parents'])) {

            $parents = $_POST['depdrop_parents'];
            $selected_id = $_POST['depdrop_all_params']['selected_id2'];

            if ($parents != null) {
                //Lets get topics that a farmer has already been trained on
                $topic_ids = [];
                $topic_ids1 = [];
                $final_out = [];
                $farmer_trained_topics = \backend\models\MeFaabsTrainingAttendanceSheet::find()
                        ->where(['farmer_id' => $parents[0]])
                        ->andWhere(['faabs_group_id' => $parents[1]])
                        ->asArray()
                        ->all();
                //  \Yii::warning($farmer_trained_topics);

                $faabs_topics = \backend\models\MeFaabsTrainingTopicEnrolment::find()
                        ->where(['faabs_id' => $parents[1]])
                        ->asArray()
                        ->all();



                if (!empty($farmer_trained_topics)) {

                    //We make sure that the topic we are trying to update is also in the list
                    foreach ($farmer_trained_topics as $trained_topic) {
                        if ($selected_id != $trained_topic['topic']) {
                            array_push($topic_ids1, $trained_topic['topic']);
                        }
                    }

                    foreach ($faabs_topics as $topic) {
                        array_push($topic_ids, $topic['topic_id']);
                    }

                    //\Yii::warning($topic_ids);

                    $training_topics = \backend\models\MeFaabsTrainingTopics::find()
                            ->select(["CONCAT(category,' - ',topic) as name", 'id'])
                            ->where(['IN', 'id', $topic_ids])
                            ->orderBy(['id' => SORT_ASC])
                            ->asArray()
                            ->all();

                    foreach ($training_topics as $topics) {
                        if (!in_array($topics['id'], $topic_ids1)) {
                            $_arr = [
                                'id' => $topics['id'],
                                'name' => $topics['name']
                            ];
                            array_push($final_out, $_arr);
                        }
                    }

                    // \Yii::warning($final_out);
                    return ['output' => $final_out, 'selected' => $selected_id];
                } else {
                    //  \Yii::warning("Selected::::");
                    //  \Yii::warning($selected_id);
                    if (!empty($faabs_topics)) {
                        foreach ($faabs_topics as $topic) {
                            array_push($topic_ids, $topic['topic_id']);
                        }

                        $out = \backend\models\MeFaabsTrainingTopics::find()
                                ->select(["CONCAT(category,' - ',topic) as name", 'id'])
                                ->where(['IN', 'id', $topic_ids])
                                ->orderBy(['id' => SORT_ASC])
                                ->asArray()
                                ->all();
                    }
                    return ['output' => $out, 'selected' => $selected_id];
                }
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionTopic() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            //$selected_id = $_POST['depdrop_all_params']['selected_id2'];

            if ($parents != null) {
                $topic_ids = [];
                $faabs_topics = \backend\models\MeFaabsTrainingTopicEnrolment::find()
                        ->where(['faabs_id' => $parents[0]])
                        ->asArray()
                        ->all();
                if (!empty($faabs_topics)) {
                    foreach ($faabs_topics as $topic) {
                        array_push($topic_ids, $topic['topic_id']);
                    }

                    $out = \backend\models\MeFaabsTrainingTopics::find()
                            ->select(["CONCAT(category,' - ',topic) as name", 'id'])
                            ->where(['IN', 'id', $topic_ids])
                            ->orderBy(['id' => SORT_ASC])
                            ->asArray()
                            ->all();
                    \Yii::warning("OUTPUT::::");
                    \Yii::warning($out);
                    return ['output' => $out, 'selected' => ""];
                }
            }
        }
        return ['output' => '', 'selected' => ''];
    }

}
