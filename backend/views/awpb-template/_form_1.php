<?php
use kartik\helpers\Html;
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;
//use kartik\form\ActiveForm;
use backend\models\AwpbComponent;
use yii\helpers\ArrayHelper;

use kartik\depdrop\DepDrop;

use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\models\User;
use backend\models\Storyofchange;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use kartik\icons\Icon;
use lo\widgets\modal\ModalAjax;


?>
<div class="card card-success card-outline">
    <div class="card-body">
    <?php            
//	$form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL, 'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],'options' => ['enctype' => 'multipart/form-data']]);
	//$form = ActiveForm::begin(); 
  
	?>

<?php
$form = ActiveForm::begin([
        ]);
?>

	<div class="row">
		<div class="col-md-9">
    

     <?= $form->field($model, 'budget_theme')->textarea(['rows' => 2]) ?>
    

    <?= $form->field($model, 'comment')->textarea(['rows' => 2]) ?>
    
  

	
        <!-- <div id="w3" class="card kv-box">        
    
        <div class="card-header">
        <b>Activities</b>
    </div>
    <div class="card-body">
   
   
    </div>
  </div> -->
  
  </div> 
  <div class="col-md-3"> 
  <h4>Instructions</h4>
        <ol>
            <?php
             echo '<li>Fields marked with * are required</li> ';
             echo '<li>Select activities that will be undertaken during '.$model->fiscal_year.' fiscal year</li> ';
            
            ?>
        </ol>

  </div>        
</div>
  </div>
    </div>

 
    
    </div>
<div class="row">
	<div class="col-md-12">
    <div class="form-group">
        <?= Html::submitButton('Save
        ..
        +
        
        ', ['class' => 'btn btn-success']) ?>
    </div>
	 </div>
	  </div>

    <?php ActiveForm::end(); ?>

</div>

 </div>


<?php   $this->registerJs("jQuery('#checkAll').change(function(){jQuery('.activity').prop('checked',this.checked?'checked':'');})");?>