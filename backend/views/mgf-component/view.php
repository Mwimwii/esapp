<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\MgfInputItem;
use frontend\models\MgfInputCost;
/* @var $this yii\web\View */
/* @var $model frontend\models\MgfComponent */

$this->title = $model->component_name;
$usertype=Yii::$app->user->identity->type_of_user;
$costs=MgfInputCost::find()->all();

?>
<div class="mgf-component-view">

    <h3><?= Html::encode($this->title) ?></h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'component_no',
            'component_name',
            'proposal.project_title',
            'proposal.organisation.cooperative',
            'subtotal',
            'date_created',
            'createdby',
       
        ],
    ]);if($usertype=="Applicant"){
        echo Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['components'], ['class' => 'btn btn-default']);
        }else{
          echo Html::a('<i class="glyphicon glyphicon-backward"></i>Back', ['index'], ['class' => 'btn btn-default']);
        }?>
</div>



