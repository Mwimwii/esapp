<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MgfCostsFinancingPlan;
use frontend\models\MgfActivity;
use frontend\models\MgfInputItem;
use frontend\models\MgfInputCost;
use frontend\models\MgfCostsFinancingPlanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MgfCostsFinancingPlanController implements the CRUD actions for MgfCostsFinancingPlan model.
 */
class MgfCostsFinancingPlanController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionSubcat() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            //  Yii::warning('**********************', var_export($_POST['depdrop_parents'],true));
            //   $parents = $_POST['depdrop_all_params']['parent_id'];
            $selected_id = $_POST['depdrop_params'];
            if ($parents != null) {
                $componentid = $parents[0];
                $out = \frontend\models\MgfActivity::find()
                        ->select(['id', 'activity_name as name'])
                        ->where(['componet_id' => $componentid])
                        ->asArray()
                        ->all();

                return ['output' => $out, 'selected' => $selected_id[0]];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionGetInputs() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            //  Yii::warning('**********************', var_export($_POST['depdrop_parents'],true));
            //   $parents = $_POST['depdrop_all_params']['parent_id'];
            $selected_id = $_POST['depdrop_params'];
            if ($parents != null) {
                $componentid = $parents[0];
                $out = \frontend\models\MgfInputItem::find()
                        ->select(['id', 'input_name as name'])
                        ->where(['activity_id' => $componentid])
                        ->asArray()
                        ->all();

                return ['output' => $out, 'selected' => $selected_id[0]];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    /**
     * Lists all MgfCostsFinancingPlan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MgfCostsFinancingPlanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MgfCostsFinancingPlan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    public function actionUpdate($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())){
            $activity=MgfActivity::findOne($model->activityid);
            $total_contribution=$model->Applicant_in_kind + $model->Applicant_in_cash;
            $total=$model->mgf_grant + $model->other_sources +$total_contribution;
            $mgf_as_percent=($total_contribution/$total)*100;
            $model->total_contribution=$total_contribution;
            $model->total=$total;
            $model->mgf_as_percent=$mgf_as_percent;
            $model->date_update=date('Y-m-d H:i:s');
            $model->componentid=$activity->componet_id;
            $model->updated_by=Yii::$app->user->identity->id;    
            if($model->save()){
                return $this->redirect(['mgf-component/costplan', 'id' => $activity->componet_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MgfCostsFinancingPlan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MgfCostsFinancingPlan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MgfCostsFinancingPlan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MgfCostsFinancingPlan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
