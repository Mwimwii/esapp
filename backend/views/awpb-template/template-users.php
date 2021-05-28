<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
//use yii\widgets\ActiveForm;
use backend\models\AwpbTemplate;

/* @var $this yii\web\View */
/* @var $model backend\models\Storyofchange */

$this->title = 'Link Users';
$this->params['breadcrumbs'][] = ['label' => 'AWPB Template', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "AWPB Template Check list", 'url' => ['check-list', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Activities</a>
            </li>
            <li class="nav-item">
                <?php
                if ($model->status == \backend\models\AwpbTemplate::STATUS_DRAFT) {
                    echo Html::a('AWPB Template Check list', ['check-list', 'id' => $model->id], ['class' => 'nav-link']);
                } else {
                    echo Html::a('View AWPB Template', ['view', 'id' => $model->id], ['class' => 'nav-link']);
                }
                ?>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                <h5>Instructions</h5>
                <ol>
                    <li>The list below allows you to select users that be allowed to undertake budgetting activities for the <code><?php echo $fiscal_year ?> fiscal year</code>
                    </li>
                    <li>You can select specific users or select all by ticking <code>Check all users checkbox</code>
                    </li>
                    <li>Once you are done with selection, click "<span class="badge badge-success">Save</span>" button to save the selected users
                    </li>
                   
                        <?php
                        // if ($model->status == \backend\models\AwpbBudgetGuideline::STATUS_DRAFT) {
                        //     echo "<li>Once you are done adding media, click";
                        //     echo '"' . Html::a('AWPB Template Check list', ['check-list', 'id' => $model->id], ['class' => '']) . '" to continue with the Check list';
                        // } else {
                        //     echo "<li>Once you are done, click";
                        //     echo '"' . Html::a('View AWPB Template', ['view', 'id' => $model->id], ['class' => '']) . '" to view AWPB template details';
                        // }
                        ?>
                    </li>
                </ol>     
                <h5>User List<span class="required"><code>*</code></span></h5>
                <?php


$form = ActiveForm::begin([
    ]);
?>


                <div class="card card-success card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                     
                    </div>
                    <div class="card-body">

            <div class="row">

<div class="form-group col-lg-12">
<div class="form-group field-role-rights">
   
 <?php 

if(!$model->isNewRecord) {

    $query =  \backend\models\AwpbTemplateUsers::find()
    ->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_name),' ',last_name) as name", 'user_id as id'])
    ->where(['awpb_template_id'=>$model->id])        
    ->orderBy(['last_name' => SORT_ASC])
 
    ->all();

$model->users =$query; //ArrayHelper::map($query, 'id', 'name')
}
    
$query1 = \backend\models\User::find()
->select(['CONCAT(CONCAT(CONCAT(title,\' \',first_name),\' \',other_name),\' \',last_name) as last_name', 'id'])

->where(['status' => \backend\models\User::STATUS_ACTIVE])            
->orderBy(['last_name' => SORT_ASC])
//->asArray()
->all();

?>


<?=
  $form->field($model, 'users')->checkboxList(ArrayHelper::map($query1, 'id', 'last_name'), [
    

   // $form->field($model, 'users')->checkboxList(\backend\models\User::getAwpbTemplateUsers(), [
        'item' => function($index, $label, $name, $checked, $value) {
            $checked = $checked ? 'checked' : '';
                           return "<label  > <input type='checkbox' {$checked} name='{$name}' class ='user' value='{$value}'> {$label} </label>";
        }
        , 'separator' => ' ', 'required' => true])->label('<h7>Check all users <label><input type="checkbox" id="checkAll"></label></h7>')
    ?>

<?php   $this->registerJs("jQuery('#checkAll').change(function(){jQuery('.user').prop('checked',this.checked?'checked':'');})");?>

</div>
</div>

</div></div>


                    
                    </div> 
                     </div>
              

                     <div class="col-lg-12 form-group">&nbsp;</div>
                <div class="col-lg-12 form-group">
<?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
                     <?php ActiveForm::end(); ?>




             

            </div>
        </div>
    </div>
    <!-- /.card -->
</div>

