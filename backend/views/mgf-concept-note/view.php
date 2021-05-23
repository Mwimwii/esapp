<?php

use frontend\models\MgfApplication;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfConceptNote */


$usertype=Yii::$app->user->identity->type_of_user;
$application=MgfApplication::findOne(['id'=>$model->application_id]);
$this->title = "MFG Concept Note (".$application->application_status.')';
\yii\web\YiiAsset::register($this);
?>
<div class="mgf-concept-note-view">
    <h2><?= Html::encode($this->title) ?></h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_title',
            'estimated_cost',
            'starting_date',
            'operation.operation_type',
            'implimentation_period',
            'other_operation_type:ntext',
            'organisation.cooperative',
            'date_created',
            'date_submitted',
        ],
        ])?>
<?php if($usertype=="Applicant") {
    echo Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['/mgf-applicant/profile'], ['class' => 'btn btn-default']);
    echo Html::a('<i class="glyphicon glyphicon-edit"></i>Update', ['update','id'=>$model->id], ['class' => 'btn btn-primary']);
}else{
   echo Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default']);   
} ?>
</div>
