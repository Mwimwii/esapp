<?php
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbFundsRequisitionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Annual Work Plan and Budget';
$this->params['breadcrumbs'][] = $this->title;

$model = new \backend\models\AwpbBudget();
$form = ActiveForm::begin();

?>
<div class="card card-success card-outline">
    <div class="card-body" style="overflow: auto;">

        
        <div class="row" style="">
             <div class="col-lg-12">
             <?php echo Html::a('<span class="fas fa-arrow-left fa-2x"></span>', ['qofrd', 'id' => 0, 'id2' => 0, 'status' => 1], [
    'title' => 'back',
    'data-toggle' => 'tooltip',
    'data-placement' => 'top',
    ]); ?>
             </div>
            <div class="col-lg-12">
                <h5>Instructions</h5>
        
                <ol>
                    <li>Select the fiscal year and click <span class="badge badge-success">Filter</span> button to view Annual Work Plan and Budget.
                    </li>
                    


                </ol>
            </div></div>
 <div class="row" style="">
            <div class="col-lg-4">
                
                 <?=
                $form->field($model, 'awpb_template_id', [
                    'addon' => [
                        'append' => [
                            'content' => Html::submitButton('Filter', ['name' => 'awpb_template', 'value' => 'true', 'class' => 'btn btn-success btn-sm']),
                            'asButton' => true
                        ]
                    ]
                ])->dropDownList(
                       (\backend\models\AwpbTemplate::getAwpbTemplateList()), [
                    'custom' => true,
                    'prompt' => 'Filter by Fiscal Year',
                    'required' => true,
                        ]
                );
                ?>
 
                
            </div>

 </div>
   
    <?php
     ActiveForm::end();
     
     if ( $awpb_template_id >0){
    
    

$time = new \DateTime('now');
$today = $time->format('Y-m-d');
$template_model = \backend\models\AwpbTemplate::find()->where(['id' =>$awpb_template_id])->one();

$mo1 = "";
$mo2 = "";
$mo3 = "";
if ($template_model->quarter == 1) {
$mo1 = "Jan";
$mo2 = "Feb";
$mo3 = "Mar";
}
if ($template_model->quarter == 2) {
$mo1 = "Apr";
$mo2 = "May";
$mo3 = "Jun";
}
if ($template_model->quarter == 3) {
$mo1 = "Jul";
$mo2 = "Aug";
$mo3 = "Sep";
}
if ($template_model->quarter == 2) {
$mo1 = "Oct";
$mo2 = "Nov";
$mo3 = "Dec";
}

?>
            
 <div class="row" style="">
     <div class="col-lg-12">     <h3><?= $template_model->fiscal_year .' '.Html::encode($this->title) ?></h3> </div></div>
                    <hr class="dotted short">
   
        
  <table class="table table-bordered table-sm" style="overflow-x: auto;display: block;overflow: scroll;">
                 

<?php
$parent_components = \backend\models\AwpbComponent::find()->where(['type' => 0])
->orderBy(['code' => SORT_ASC])
->all();

if (!empty($parent_components)) {
     $grand_quarter_one_quantity=0;
                                    
 $grand_quarter_two_quantity=0; 
 $grand_quarter_three_quantity=0;
 $grand_quarter_four_quantity=0;
                 
 $grand_quarter_one_amount=0;             
  $grand_quarter_two_amount=0;
 $grand_quarter_three_amount=0;
  $grand_quarter_four_amount=0;
 $grand_total_amount=0;
     
 $grand_funder_ifad=0;        
 $grand_funder_ifad_amount=0;
 $grand_funder_ifad_grant=0;              
 $grand_funder_ifad_grant_amount=0;
  $grand_funder_grz=0;        
 $grand_funder_grz_amount=0;
 $grand_funder_beneficiaries=0;             
 $grand_funder_beneficiaries_amount=0;
 $grand_funder_private_sector=0;              
  $grand_funder_private_sector_amount=0;
  $grand_funder_iapri=0;             
 $grand_funder_iapri_amount=0;
  $grand_funder_parm=0;             
  $grand_funder_parm_amount=0;
 $grand_funder_budget_amount=0;

    echo ' <tr>
                    <td colspan="2"><strong>Description</strong></td>
                    
                    <td rowspan="2"><strong>Unit of Measure</strong></td>
                    
                    <td colspan="5"><strong>M&E</strong></td>
                    <td rowspan="1" colspan="1"><strong>Total USD</strong></td>
                    <td rowspan="1" colspan="4"><strong> Activities/Input Schedule and Quantities</strong></td>
                  
                    <td colspan="6"><strong>Budget</strong></td>
                   
                    <td colspan="15"><strong>Sources of Funds</strong></td>
                </tr>
                ';

echo ' <tr>
                    <td rowspan="1"><strong>Code</strong></td>
                    <td rowspan="1"><strong>Component/Sub-comp/Outcome/Output/Indicator/ Activities/Inputs</strong></td>
                   
                    <td colspan="1"><strong>Programme Target</strong></td>
                    <td colspan="1"><strong>Programme Accumulative Achievement</strong></td>
                    
                    <td colspan="1"><strong>% of Programme Target</strong></td>
                    <td colspan="1"><strong>Programme Balance</strong></td>
                    <td colspan="1" ><strong>2021 Target</strong></td>
                    <td><strong></strong></td>
                    <td><strong>Q1</strong></td>
                     <td><strong>Q2</strong></td>
                      <td><strong>Q3</strong></td>
                       <td><strong>Q4</strong></td>
                        <td colspan="1"><strong>Unit Cost</strong></td>
                       <td><strong>Q1</strong></td>
                     <td><strong>Q2</strong></td>
                      <td><strong>Q3</strong></td>
                       <td><strong>Q4</strong></td>
                        <td colspan="1"><strong>Total</strong></td>
                      
                       
                      <td colspan="2"><strong>IFAD</strong></td>
                       <td colspan="2"><strong>GOVT Counterpart</strong></td>
                        <td colspan="2"><strong>Beneficiaries</strong></td>
                         <td colspan="2"><strong> Private Sector</strong></td>
                          <td colspan="2"><strong>IAPRI</strong></td>
                           <td colspan="2"><strong>PARM</strong></td>
                            <td colspan="2"><strong> IFAD Grant </strong></td>
                            <td rowspan="3"><strong> Total (USD) </strong></td>
               
                <tr>';

echo ' <tr>
                 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>  <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td><td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
                                    
 <td><strong></strong></td> 
 <td><strong></strong></td><td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>                 
 <td><strong></strong></td> 
 <td><strong></strong></td><td><strong></strong></td><td><strong></strong></td>
                 

                        <td><strong></strong></td> 
                         <td><strong>%</strong></td>
                         <td><strong>USD</strong></td>
                         <td><strong>%</strong></td>
                         <td><strong>USD</strong></td>
                         <td><strong>%</strong></td>
                         <td><strong>USD</strong></td>
                         <td><strong>%</strong></td>
                         <td><strong>USD</strong></td>
                         <td><strong>%</strong></td>
                         <td><strong>USD</strong></td>
                         <td><strong>%</strong></td>
                         <td><strong>USD</strong></td>
                         <td><strong>%</strong></td>
                         <td><strong>USD</strong></td>
                         
                </tr>
                ';

foreach ($parent_components as $parent_component) {

echo ' <tr>
                 
                 
 <td colspan="2"><strong> Component '.$parent_component->code. ': '.$parent_component->name .'</strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
                                    
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
<td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
                                    
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
 <td><strong></strong></td>
                      <td><strong></strong></td>  
                </tr>
                ';
$components = \backend\models\AwpbComponent::find()->where(['parent_component_id' => $parent_component->id])
->orderBy(['code' => SORT_ASC])
->all();
$parent_component_id = "";
if (!empty($components)) {
$grand_total = 0.0;
$main_component_total = 0.0;
$total_quarter_one_quantity=0;
                                    
 $total_quarter_two_quantity=0; 
 $total_quarter_three_quantity=0;
 $total_quarter_four_quantity=0;
                 
 $total_quarter_one_amount=0;             
  $total_quarter_two_amount=0;
 $total_quarter_three_amount=0;
  $total_quarter_four_amount=0;
 $total_total_amount=0;
     
 $total_funder_ifad=0;        
 $total_funder_ifad_amount=0;
 $total_funder_ifad_grant=0;              
 $total_funder_ifad_grant_amount=0;
  $total_funder_grz=0;        
 $total_funder_grz_amount=0;
 $total_funder_beneficiaries=0;             
 $total_funder_beneficiaries_amount=0;
 $total_funder_private_sector=0;              
  $total_funder_private_sector_amount=0;
  $total_funder_iapri=0;             
 $total_funder_iapri_amount=0;
  $total_funder_parm=0;             
  $total_funder_parm_amount=0;
 $total_funder_budget_amount=0;
 $grand_total_quarter_one_quantity=0;
                                    
 $grand_total_quarter_two_quantity=0; 
 $grand_total_quarter_three_quantity=0;
 $grand_total_quarter_four_quantity=0;
                 
 $grand_total_quarter_one_amount=0;             
  $grand_total_quarter_two_amount=0;
 $grand_total_quarter_three_amount=0;
  $grand_total_quarter_four_amount=0;
 $grand_total_total_amount=0;
     
 $grand_total_funder_ifad=0;        
 $grand_total_funder_ifad_amount=0;
 $grand_total_funder_ifad_grant=0;              
 $grand_total_funder_ifad_grant_amount=0;
  $grand_total_funder_grz=0;        
 $grand_total_funder_grz_amount=0;
 $grand_total_funder_beneficiaries=0;             
 $grand_total_funder_beneficiaries_amount=0;
 $grand_total_funder_private_sector=0;              
  $grand_total_funder_private_sector_amount=0;
  $grand_total_funder_iapri=0;             
 $grand_total_funder_iapri_amount=0;
  $grand_total_funder_parm=0;             
  $grand_total_funder_parm_amount=0;
 $grand_total_funder_budget_amount=0;


$component_id="";
foreach ($components as $component) {


$component_total = 0.0;
$main_component = "";

//$parent_component = \backend\models\AwpbComponent::findOne(['id' => $component->parent_component_id]);

//if (!empty($parent_component)) {
//$main_component = $parent_component->code;
//
//}


echo ' <tr>
                 
 <td colspan="2"><strong> Sub-Component '.$component->code. ': '.$component->name .'</strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
                                    
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
<td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
                                    
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
 <td><strong></strong></td>
          <td><strong></strong></td>              
                </tr>
                ';
?>


                <?php
                $output = "";
                $output_model = \backend\models\AwpbOutput::findOne(['component_id' => $component->id]);

                if (!empty($output_model)) {
                $output = $output_model->code . ' ' . $output_model->name;

                $indicators = \backend\models\AwpbIndicator::find()->where(['output_id' => $output_model->id])->orderBy(['component_id' => SORT_ASC])
                ->all();
                $count = \backend\models\AwpbIndicator::find()->where(['output_id' => $output_model->id])->count();
                //$count = $indicators;
                if (!empty($indicators)) {
                echo '<tr>
                 
 <td rowspan='. $count.'><strong> Output '. $output .'</strong></td> ';
                foreach ($indicators as $indicator) {
                echo '
               
 <td><strong>'.$indicator->name.'</strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
                                    
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
<td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
                                    
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
 <td><strong></strong></td>
                  <td><strong></strong></td>  
                   <td><strong></strong></td>
                </tr>
                ';
                }}}

                $outcome = "";
                $outcome_model = \backend\models\AwpbOutcome::findOne(['component_id' => $component->id]);

                if (!empty($outcome_model)) {
                $outcome = $outcome_model->outcome_code . ' ' . $output_model->name;
                echo ' <tr>
                 
 <td colspan="1"><strong> Outcome '.$outcome_model->outcome_code. ': '.$output_model->name .'</strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 <td><strong></strong></td> 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
                                    
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
<td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
                                    
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
 <td><strong></strong></td>
         <td><strong></strong></td>               
                </tr>
                ';
                }

                $parent_activities = \backend\models\AwpbActivity::find()->where(['type' => 0])->andWhere(['component_id' => $component->id])
                ->orderBy(['activity_code' => SORT_ASC])
                ->all();

                if (!empty($parent_activities)) {

                foreach ($parent_activities as $parent_activity) {

              

                echo ' <tr>
                 
 <td colspan="1"><strong>'. $parent_activity->activity_code .'</strong></td> 
 <td><strong>'. $parent_activity->name .'</strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
                                    
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
<td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
                                    
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
                 
 <td><strong></strong></td> 
 <td><strong></strong></td>                 
 <td><strong></strong></td> 
 <td><strong></strong></td>
 <td><strong></strong></td>
 <td><strong></strong></td>
                        <td><strong></strong></td>
                         <td><strong></strong></td>
                </tr>
                ';
                  $awpb_activity = \backend\models\AwpbActivity::find()->where(['parent_activity_id' => $parent_activity->id])->all();

                if (!empty($awpb_activity)) {
                foreach ($awpb_activity as $activity) {
                     $component_id =$activity->component_id;  
                $target = 0;

                $funder = \backend\models\AwpbTemplateActivity::find()->where(['activity_id' => $activity->id, 'awpb_template_id' => $template_model->id])->one();
                $target_quantity = \backend\models\AwpbBudget::find()->where(['activity_id' => $activity->id,'awpb_template_id' => $template_model->id])->sum('total_amount');
                $fiscal_target_quantity = \backend\models\AwpbBudget::find()->where(['activity_id' => $activity->id,'awpb_template_id' => $template_model->id])->sum('total_quantity');
                $quarter_one_quantity = \backend\models\AwpbBudget::find()->where(['activity_id' =>$activity->id,'awpb_template_id' => $template_model->id])->sum('quarter_one_quantity');
                $quarter_two_quantity = \backend\models\AwpbBudget::find()->where(['activity_id' => $activity->id,'awpb_template_id' => $template_model->id])->sum('quarter_two_quantity');
                $quarter_three_quantity = \backend\models\AwpbBudget::find()->where(['activity_id' => $activity->id,'awpb_template_id' => $template_model->id])->sum('quarter_three_quantity');
                $quarter_four_quantity = \backend\models\AwpbBudget::find()->where(['activity_id' => $activity->id,'awpb_template_id' => $template_model->id])->sum('quarter_four_quantity');

                $total_amount = \backend\models\AwpbBudget::find()->where(['activity_id' => $activity->id,'awpb_template_id' => $template_model->id])->sum('total_amount');
                $quarter_one_amount = \backend\models\AwpbBudget::find()->where(['activity_id' => $activity->id,'awpb_template_id' => $template_model->id])->sum('quarter_one_amount');
                $quarter_two_amount = \backend\models\AwpbBudget::find()->where(['activity_id' => $activity->id,'awpb_template_id' => $template_model->id])->sum('quarter_two_amount');
                $quarter_three_amount = \backend\models\AwpbBudget::find()->where(['activity_id' => $activity->id,'awpb_template_id' => $template_model->id])->sum('quarter_three_amount');
                $quarter_four_amount = \backend\models\AwpbBudget::find()->where(['activity_id' => $activity->id,'awpb_template_id' => $template_model->id])->sum('quarter_four_amount');

                $unit = "";
                $unit_of_me = \backend\models\AwpbUnitOfMeasure::findOne(['id' => $activity->unit_of_measure_id]);

                if (!empty($unit_of_me)) {
                $unit = $unit_of_me->name;
                }
                $programme_balance =  $activity->cumulative_actual -$activity->programme_target;
                  $programme_percent =  ($activity->cumulative_actual /$activity->programme_target)*100;
                echo ' <tr>
                 
 <td colspan="1"> '. $activity->activity_code. '</td> 
 <td>'. $activity->name. '</td>
 <td>'. $unit. '</td>
                 
 <td>'. $activity->programme_target. '</td> 
 <td>'. $activity->cumulative_actual. '</td>

                 <td>'. $programme_percent. '</td> '
                        . '<td>'. $programme_balance. '</td>
 <td>'. $fiscal_target_quantity. '</strong></td> 
     <td><strong></strong></td> 
 <td style="text-align:right">' . number_format((float) $quarter_one_quantity, 2, '.', '') . '</td>
                                    
 <td style="text-align:right">' . number_format((float) $quarter_two_quantity, 2, '.', '') . '</td> 
 <td style="text-align:right">' . number_format((float) $quarter_three_quantity, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float) $quarter_four_quantity, 2, '.', '') . '</td>
                 
 <td><strong></strong></td> 
 <td style="text-align:right">' . number_format((float) $quarter_one_amount, 2, '.', '') . '</td>             
  <td style="text-align:right">' . number_format((float) $quarter_two_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float) $quarter_three_amount, 2, '.', '') . '</td>
  <td style="text-align:right">' . number_format((float) $quarter_four_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float) $total_amount, 2, '.', '') . '</td>
     '
                        ;
                
    if (!empty($funder)){
        
    echo '
 <td style="text-align:right">' . number_format((float) $funder->ifad, 2, '.', '') . '</td>        
 <td style="text-align:right">' . number_format((float) $funder->ifad_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float) $funder->ifad_grant, 2, '.', '') . '</td>              
 <td style="text-align:right">' . number_format((float) $funder->ifad_grant_amount, 2, '.', '') . '</td>
  <td style="text-align:right">' . number_format((float) $funder->grz, 2, '.', '') . '</td>        
 <td style="text-align:right">' . number_format((float) $funder->grz_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float) $funder->beneficiaries, 2, '.', '') . '</td>             
 <td style="text-align:right">' . number_format((float) $funder->beneficiaries_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float) $funder->private_sector, 2, '.', '') . '</td>              
  <td style="text-align:right">' . number_format((float) $funder->private_sector_amount, 2, '.', '') . '</td>
     <td style="text-align:right">' . number_format((float) $funder->iapri, 2, '.', '') . '</td>             
 <td style="text-align:right">' . number_format((float) $funder->iapri_amount, 2, '.', '') . '</td>
      <td style="text-align:right">' . number_format((float) $funder->parm, 2, '.', '') . '</td>             
  <td style="text-align:right">' . number_format((float) $funder->parm_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float) $funder->budget_amount, 2, '.', '') . '</td>

           </tr> ';
 
 $total_quarter_one_quantity= $total_quarter_one_quantity + $quarter_one_quantity;                                   
 $total_quarter_two_quantity=$total_quarter_two_quantity + $quarter_two_quantity;
 $total_quarter_three_quantity=$total_quarter_three_quantity + $quarter_three_quantity;
 $total_quarter_four_quantity=$total_quarter_four_quantity + $quarter_four_quantity;
                 
 $total_quarter_one_amount=  $total_quarter_one_amount +  $quarter_one_amount;             
  $total_quarter_two_amount=$total_quarter_two_amount +  $quarter_two_amount; 
 $total_quarter_three_amount=$total_quarter_three_amount +  $quarter_three_amount; 
  $total_quarter_four_amount=$total_quarter_four_amount +  $quarter_four_amount; 
 $total_total_amount= $total_total_amount + $total_amount;
     
 $total_funder_ifad= $total_funder_ifad +$funder->ifad;       
 $total_funder_ifad_amount=$total_funder_ifad_amount+$funder->ifad_amount;
 $total_funder_ifad_grant= $total_funder_ifad_grant + $funder->ifad_grant ;            
 $total_funder_ifad_grant_amount= $total_funder_ifad_grant_amount + $funder->ifad_grant_amount;
  $total_funder_grz=  $total_funder_grz +  $funder->grz;      
 $total_funder_grz_amount=  $total_funder_grz_amount + $funder->grz_amount;
 $total_funder_beneficiaries=  $total_funder_beneficiaries +  $funder->beneficiaries;            
 $total_funder_beneficiaries_amount = $total_funder_beneficiaries_amount +$funder->beneficiaries_amount;
 $total_funder_private_sector= $total_funder_private_sector+ $funder->private_sector;           
  $total_funder_private_sector_amount= $total_funder_private_sector_amount + $funder->private_sector_amount;
  $total_funder_iapri= $total_funder_iapri + $funder->iapri;         
 $total_funder_iapri_amount=  $total_funder_iapri_amount +  $funder->iapri_amount;
  $total_funder_parm=     $total_funder_parm + $funder->parm;   
  $total_funder_parm_amount= $total_funder_parm_amount + $funder->parm_amount;
 $total_funder_budget_amount = $total_funder_budget_amount+ $funder->budget_amount;
     
  
 $grand_total = $grand_total + $main_component_total;
                $main_component_total = 0.0;
                
            
    }
 else {
      
      echo '
 <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>        
 <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>
  <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>        
 <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>
      <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>        
 <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>
      <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>        
 <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>
      <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>        
 <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>
      <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>        
 <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>
      <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>        
 <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>
      <td style="text-align:right">' . number_format((float) 0, 2, '.', '') . '</td>

           </tr> ';
    }
                
  
//$component_id = $component->id;  
 }
 
 
 
  
    }
 
         
                }
                if ($component_id == $component->id){
                
   echo'  <tr>
                        <td colspan="9" style="text-align:right"><strong>Sub-comp ' . $component->code . ' total:</strong> </td>
 <td style="text-align:right">' . number_format((float)  $total_quarter_one_quantity, 2, '.', '') . '</td>
                                    
 <td style="text-align:right">' . number_format((float)  $total_quarter_two_quantity, 2, '.', '') . '</td> 
 <td style="text-align:right">' . number_format((float)  $total_quarter_three_quantity, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float)  $total_quarter_four_quantity, 2, '.', '') . '</td>
                 
 <td><strong></strong></td> 
 <td style="text-align:right">' . number_format((float)  $total_quarter_one_amount, 2, '.', '') . '</td>             
  <td style="text-align:right">' . number_format((float)  $total_quarter_two_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float)  $total_quarter_three_amount, 2, '.', '') . '</td>
  <td style="text-align:right">' . number_format((float)  $total_quarter_four_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float) $total_total_amount, 2, '.', '') . '</td>
     
 <td><strong></strong></td>      
 <td style="text-align:right">' . number_format((float) $total_funder_ifad_amount, 2, '.', '') . '</td>
 <td><strong></strong></td>             
 <td style="text-align:right">' . number_format((float) $total_funder_ifad_grant_amount, 2, '.', '') . '</td>
   <td><strong></strong></td>       
 <td style="text-align:right">' . number_format((float) $total_funder_grz_amount, 2, '.', '') . '</td>
 <td><strong></strong></td>            
 <td style="text-align:right">' . number_format((float) $total_funder_beneficiaries_amount, 2, '.', '') . '</td>
 <td><strong></strong></td>             
  <td style="text-align:right">' . number_format((float) $total_funder_private_sector_amount, 2, '.', '') . '</td>
      <td><strong></strong></td>          
 <td style="text-align:right">' . number_format((float) $total_funder_iapri_amount, 2, '.', '') . '</td>
   <td><strong></strong></td>            
  <td style="text-align:right">' . number_format((float) $total_funder_parm_amount, 2, '.', '') . '</td>
 
 <td style="text-align:right">' . number_format((float) $total_funder_budget_amount, 2, '.', '') . '</td>

           </tr> ';
    
 
                
                
}
     // $component_id = $parent_activity->component_id;
//$component_id = $component->id;
    }
//sub
                     
    }
    
     $grand_total_quarter_one_quantity= $grand_total_quarter_one_quantity + $total_quarter_one_quantity;                                   
 $grand_total_quarter_two_quantity=$grand_total_quarter_two_quantity + $total_quarter_two_quantity;
 $grand_total_quarter_three_quantity=$grand_total_quarter_three_quantity + $total_quarter_three_quantity;
 $grand_total_quarter_four_quantity=$grand_total_quarter_four_quantity + $total_quarter_four_quantity;
                 
 $grand_total_quarter_one_amount=  $grand_total_quarter_one_amount +  $total_quarter_one_amount;             
  $grand_total_quarter_two_amount=$grand_total_quarter_two_amount +  $total_quarter_two_amount; 
 $grand_total_quarter_three_amount=$grand_total_quarter_three_amount +  $total_quarter_three_amount; 
  $grand_total_quarter_four_amount=$grand_total_quarter_four_amount +  $total_quarter_four_amount; 
 $grand_total_total_amount= $grand_total_total_amount + $total_total_amount;
     
 $grand_total_funder_ifad= $grand_total_funder_ifad +$total_funder_ifad;       
 $grand_total_funder_ifad_amount=$grand_total_funder_ifad_amount+$total_funder_ifad_amount;
 $grand_total_funder_ifad_grant= $grand_total_funder_ifad_grant + $total_funder_ifad_grant ;            
 $grand_total_funder_ifad_grant_amount= $grand_total_funder_ifad_grant_amount + $total_funder_ifad_grant_amount;
  $grand_total_funder_grz=  $grand_total_funder_grz +  $total_funder_grz;      
 $grand_total_funder_grz_amount=  $grand_total_funder_grz_amount + $total_funder_grz_amount;
 $grand_total_funder_beneficiaries=  $grand_total_funder_beneficiaries +  $total_funder_beneficiaries;            
 $grand_total_funder_beneficiaries_amount = $grand_total_funder_beneficiaries_amount +$total_funder_beneficiaries_amount;
 $grand_total_funder_private_sector= $grand_total_funder_private_sector+ $total_funder_private_sector;           
  $grand_total_funder_private_sector_amount= $grand_total_funder_private_sector_amount + $total_funder_private_sector_amount;
  $grand_total_funder_iapri= $grand_total_funder_iapri + $total_funder_iapri;         
 $grand_total_funder_iapri_amount=  $grand_total_funder_iapri_amount +  $total_funder_iapri_amount;
  $grand_total_funder_parm=     $grand_total_funder_parm + $total_funder_parm;   
  $grand_total_funder_parm_amount= $grand_total_funder_parm_amount + $total_funder_parm_amount;
 $grand_total_funder_budget_amount = $grand_total_funder_budget_amount+ $total_funder_budget_amount; 
                 if ($component->parent_component_id === $parent_component->id) {
               
    
                      echo'  <tr>
                        <td colspan="9" style="text-align:right"><strong>Component ' . $parent_component->code . ' total:</strong> </td>
                       
                
 
     
 <td style="text-align:right">' . number_format((float)  $grand_total_quarter_one_quantity, 2, '.', '') . '</td>
                                    
 <td style="text-align:right">' . number_format((float)  $grand_total_quarter_two_quantity, 2, '.', '') . '</td> 
 <td style="text-align:right">' . number_format((float)  $grand_total_quarter_three_quantity, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float)  $grand_total_quarter_four_quantity, 2, '.', '') . '</td>
                 
 <td><strong></strong></td> 
 <td style="text-align:right">' . number_format((float)  $grand_total_quarter_one_amount, 2, '.', '') . '</td>             
  <td style="text-align:right">' . number_format((float)  $grand_total_quarter_two_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float)  $grand_total_quarter_three_amount, 2, '.', '') . '</td>
  <td style="text-align:right">' . number_format((float)  $grand_total_quarter_four_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float) $grand_total_total_amount, 2, '.', '') . '</td>
 <td><strong></strong></td>      
 <td style="text-align:right">' . number_format((float) $grand_total_funder_ifad_amount, 2, '.', '') . '</td>
 <td><strong></strong></td>             
 <td style="text-align:right">' . number_format((float) $grand_total_funder_ifad_grant_amount, 2, '.', '') . '</td>
   <td><strong></strong></td>       
 <td style="text-align:right">' . number_format((float) $grand_total_funder_grz_amount, 2, '.', '') . '</td>
 <td><strong></strong></td>            
 <td style="text-align:right">' . number_format((float) $grand_total_funder_beneficiaries_amount, 2, '.', '') . '</td>
 <td><strong></strong></td>             
  <td style="text-align:right">' . number_format((float) $grand_total_funder_private_sector_amount, 2, '.', '') . '</td>
      <td><strong></strong></td>          
 <td style="text-align:right">' . number_format((float) $grand_total_funder_iapri_amount, 2, '.', '') . '</td>
   <td><strong></strong></td>            
  <td style="text-align:right">' . number_format((float) $grand_total_funder_parm_amount, 2, '.', '') . '</td>
<td style="text-align:right">' . number_format((float) $grand_total_funder_budget_amount, 2, '.', '') . '</td>


           </tr> ';
   
    
               
 
          
    
          $parent_component_id = $component->parent_component_id;
          $grand_quarter_one_quantity= $grand_quarter_one_quantity + $grand_total_quarter_one_quantity;                                   
 $grand_quarter_two_quantity=$grand_quarter_two_quantity + $grand_total_quarter_two_quantity;
 $grand_quarter_three_quantity=$grand_quarter_three_quantity + $grand_total_quarter_three_quantity;
 $grand_quarter_four_quantity=$grand_quarter_four_quantity + $grand_total_quarter_four_quantity;
                 
 $grand_quarter_one_amount=  $grand_quarter_one_amount +  $grand_total_quarter_one_amount;             
  $grand_quarter_two_amount=$grand_quarter_two_amount +  $grand_total_quarter_two_amount; 
 $grand_quarter_three_amount=$grand_quarter_three_amount +  $grand_total_quarter_three_amount; 
  $grand_quarter_four_amount=$grand_quarter_four_amount +  $grand_total_quarter_four_amount; 
 $grand_total_amount= $grand_total_amount + $grand_total_total_amount;
     
 $grand_funder_ifad= $grand_funder_ifad +$grand_total_funder_ifad;       
 $grand_funder_ifad_amount=$grand_funder_ifad_amount+$grand_total_funder_ifad_amount;
 $grand_funder_ifad_grant= $grand_funder_ifad_grant + $grand_total_funder_ifad_grant ;            
 $grand_funder_ifad_grant_amount= $grand_funder_ifad_grant_amount + $grand_total_funder_ifad_grant_amount;
  $grand_funder_grz=  $grand_funder_grz +  $grand_total_funder_grz;      
 $grand_funder_grz_amount=  $grand_funder_grz_amount + $grand_total_funder_grz_amount;
 $grand_funder_beneficiaries=  $grand_funder_beneficiaries +  $grand_total_funder_beneficiaries;            
 $grand_funder_beneficiaries_amount = $grand_funder_beneficiaries_amount +$grand_total_funder_beneficiaries_amount;
 $grand_funder_private_sector= $grand_funder_private_sector+ $grand_total_funder_private_sector;           
  $grand_funder_private_sector_amount= $grand_funder_private_sector_amount + $grand_total_funder_private_sector_amount;
  $grand_funder_iapri= $grand_funder_iapri + $grand_total_funder_iapri;         
 $grand_funder_iapri_amount=  $grand_funder_iapri_amount +  $grand_total_funder_iapri_amount;
  $grand_funder_parm=     $grand_funder_parm + $grand_total_funder_parm;   
  $grand_funder_parm_amount= $grand_funder_parm_amount + $grand_total_funder_parm_amount;
 $grand_funder_budget_amount = $grand_funder_budget_amount+ $grand_total_funder_budget_amount; 
 }
    }
}}    $grand_total=0;

 echo'  <tr>
                      
                <td colspan="9" style="text-align:right"><strong>Grand Total:</strong> </td>
 
     
 <td style="text-align:right">' . number_format((float)  $grand_quarter_one_quantity, 2, '.', '') . '</td>
                                    
 <td style="text-align:right">' . number_format((float)  $grand_quarter_two_quantity, 2, '.', '') . '</td> 
 <td style="text-align:right">' . number_format((float)  $grand_quarter_three_quantity, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float)  $grand_quarter_four_quantity, 2, '.', '') . '</td>
                 
 <td><strong></strong></td> 
 <td style="text-align:right">' . number_format((float)  $grand_quarter_one_amount, 2, '.', '') . '</td>             
  <td style="text-align:right">' . number_format((float)  $grand_quarter_two_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float)  $grand_quarter_three_amount, 2, '.', '') . '</td>
  <td style="text-align:right">' . number_format((float)  $grand_quarter_four_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float) $grand_total_amount, 2, '.', '') . '</td>
 <td><strong></strong></td>      
 <td style="text-align:right">' . number_format((float) $grand_funder_ifad_amount, 2, '.', '') . '</td>
 <td><strong></strong></td>             
 <td style="text-align:right">' . number_format((float) $grand_funder_ifad_grant_amount, 2, '.', '') . '</td>
   <td><strong></strong></td>       
 <td style="text-align:right">' . number_format((float) $grand_funder_grz_amount, 2, '.', '') . '</td>
 <td><strong></strong></td>            
 <td style="text-align:right">' . number_format((float) $grand_funder_beneficiaries_amount, 2, '.', '') . '</td>
 <td><strong></strong></td>             
  <td style="text-align:right">' . number_format((float) $grand_funder_private_sector_amount, 2, '.', '') . '</td>
      <td><strong></strong></td>          
 <td style="text-align:right">' . number_format((float) $grand_funder_iapri_amount, 2, '.', '') . '</td>
   <td><strong></strong></td>            
  <td style="text-align:right">' . number_format((float) $grand_funder_parm_amount, 2, '.', '') . '</td>
 <td style="text-align:right">' . number_format((float)  $grand_funder_budget_amount, 2, '.', '') . '</td>
           </tr> ';
   
                ?>
               
                
 
    

                </tr> 
           
        </table>
    </div>
</div>
     <?php } ?>
