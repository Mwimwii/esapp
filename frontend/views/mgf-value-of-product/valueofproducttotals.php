<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MgfValueOfProductTotals;
use frontend\models\MgfValueOfProduct;
use frontend\models\MgfProposal;
use frontend\models\MgfApplicant;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfValueOfProductTotals */
/* @var $form ActiveForm */


$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
$proposal=MgfProposal::find()->where(['is_active'=>1,'organisation_id'=>$applicant->organisation_id])->one();
$ValueOfProduct=MgfValueofProductTotals::find()->where(['proposal_id'=>$proposal->id])->one();
$this->title = 'Totals of value of products by year';
$this->params['breadcrumbs'][] = $this->title;

?>
 <div class="valueofproducttotals">
 <div style="border: 3px outset grey;background-color: lightblue;text-align: center;">
      <h4><?= Html::encode($this->title) ?></h4>
      <?php include('comptab.php');?>
 </div>
    <?php $form = ActiveForm::begin(); ?>
    <table style="margin-left: auto;  margin-right: auto;width:100%;">
        <tr>
            <td> <?= $form->field($model, 'total_yr1_value')->textInput(['value'=>$ValueOfProduct->total_yr1_value]) ?></td>
            <td> <?= $form->field($model, 'total_yr2_value')->textInput(['value'=>$ValueOfProduct->total_yr2_value]) ?></td>
            <td><?= $form->field($model, 'total_yr3_value')->textInput(['value'=>$ValueOfProduct->total_yr3_value]) ?> </td>
            <td><?= $form->field($model, 'total_yr4_value')->textInput(['value'=>$ValueOfProduct->total_yr4_value])?> </td>
            <td><?= $form->field($model, 'proposal_id')->textInput(['value'=>$ValueOfProduct->proposal_id]) ?> </td>
        </tr>
    </table>    

          
        
        
           
        <div class="form-group">
        <?= Html::a('<i class="fa fa-backward"></i>Back', ['/mgf-value-of-product/index',], ['class' => 'btn btn-default']);?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- valueofproducttotals -->
