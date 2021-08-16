<?php

use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MgfApplicant;
use frontend\models\MgfExperience;
use frontend\models\MgfPastproject;
use frontend\models\MgfPartnership;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfExperience */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Form 3: Previous Experience with External Project Financing ';

$userid=Yii::$app->user->identity->id;
$applicant=MgfApplicant::findOne(['user_id'=>$userid]);
$experience=MgfExperience::findOne([$_GET['id']]);
$pastprojects=MgfPastproject::find()->where(['experience_id'=>$_GET['id']])->all();
$pastprojectscount=MgfPastproject::find()->where(['experience_id'=>$_GET['id']])->count();
$partnerships=MgfPartnership::find()->where(['experience_id'=>$_GET['id']])->all();
$partnershipcount=MgfPartnership::find()->where(['experience_id'=>$_GET['id']])->count();
?>

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h3><?= Html::encode($this->title) ?></h3>
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'financed_before')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => 'SELECT','required'=>true]) ?>

    <?php if($experience->financed_before=="YES"){?>
        <label>How many? Please provide information on it/them</label>
        <?= Html::button('<i class="glyphicon glyphicon-plus"></i>Add Past Projectct(s)', [ 'class' => 'btn btn-primary', 'onclick' => '$(\'#addPastProject\').modal();']);?><br/>
        <?php if($pastprojectscount>0){?>
            <?= Html::button('<i class="glyphicon glyphicon-eye-open"></i>Past Projects('.$pastprojectscount.')', [ 'class' => 'btn btn-link', 'onclick' => '$(\'#pastProjects\').modal();']);?>
            <?php foreach($pastprojects as $proj):?>
                <strong><?= $proj->project_name.','?></strong>
             <?php endforeach; ?>
        <?php } ?> 
    <?php } ?>

    <br/><br/>
    <?php if($experience->financed_before==""){}else{?>
        <?= $form->field($model, 'any_collaboration')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', ], ['prompt' => 'SELECT','required'=>true]) ?>
    <?php } ?>
    <?php if($experience->any_collaboration==""){}else{?>
        <?php if($experience->any_collaboration=="YES"){ ?>  
            <label>How many? Please provide information on it/them</label>  
            <?= Html::button('<i class="glyphicon glyphicon-plus"></i>Add Partnersip(s)', [ 'class' => 'btn btn-primary', 'onclick' => '$(\'#addPartnership\').modal();']);?><br/>
            <?php if($partnershipcount>0){?>
                <?= Html::button('<i class="glyphicon glyphicon-eye-open"></i>Added Partnerships ('.$partnershipcount.')', [ 'class' => 'btn btn-link', 'onclick' => '$(\'#addedPartnerships\').modal();']);?>
                <?php foreach($partnerships as $part):?>
                   <strong><?= $part->partner_name.','?></strong>
                <?php endforeach; ?><br/>
            <?php } ?>     
            
        <?php }else{?>
            <?= $form->field($model, 'collaboration_will')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO','N/A'=>'N/A' ], ['prompt' => 'SELECT','required'=>true]) ?>
        <?php } ?>
    <?php } ?>


    <?php if($experience->any_collaboration=="YES"){?>
        <?= $form->field($model, 'collaboration_will')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO','N/A'=>'N/A' ], ['prompt' => 'SELECT','required'=>true]) ?>
    <?php } ?>
   

    <?php if($experience->collaboration_will==""){}else{?>
       
        <?php if($experience->collaboration_will=="YES"){ ?> 
        <?php }else{?>
             <?= $form->field($model, 'collaboration_ready')->dropDownList([ 'YES' => 'YES', 'NO' => 'NO', 'N/A'=>'N/A'], ['prompt' => 'SELECT','required'=>true]) ?>
        <?php } ?>
    <?php } ?>
    <br/><br/>
   
    <div class="form-group">
        <?= Html::a('<i class="glyphicon glyphicon-backward"></i>Back',['/mgf-experience/view','id'=>$experience->id,'status'=>0], ['class' => 'btn btn-default']) ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
    <div class="col-md-2"></div>
</div>

<div class="modal fade" id="addPastProject">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Past Projects</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
            <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-experience%2Fpastproject&id='.$_GET['id'],]) ?>
              <?php $model = new MgfPastproject();?>
                <?= $form->field($model, 'project_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'amount_assisted')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'years_assisted')->dropDownList([ '1' => '1 Year', '2' => '2 Years','3' => '3 Years', '4' => '4 Years','5' => '5 Years', '6' => '6 Years','7' => '7 Years', '8' => '8 Years' ], ['prompt' => 'SELECT','required'=>true]) ?>
                <?= $form->field($model, 'obligations_met')->dropDownList([ 'YES' => 'Successful', 'NO' => 'Fail' ], ['prompt' => 'SELECT','required'=>true]) ?>
                <?= $form->field($model, 'outcome_response')->textarea(['rows' => 5,'required'=>true]) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="pastProjects">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><h3>MGF-ESSAP Past Projects</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Project Name</th>
                                <th scope="col">Amount Assisted</th>
                                <th scope="col">Period (Years)</th>
                                <th scope="col">Result</th>                          
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $ia=1; ?>
                                <?php foreach($pastprojects as $act):?>
                                    <tr class="table-active">
                                        <th scope="row"><?=$ia; ?></th>
                                        <td><?=$act->project_name; ?></td>
                                        <td><?=$act->amount_assisted; ?></td>
                                        <td><?=$act->years_assisted; ?></td>
                                        <td><?php if($act->obligations_met=="YES"){echo '<lable class="label label-success">Success</lable>';}else{echo '<lable class="label label-danger">Fail</lable>';} ?></td>
                                    </tr>
                                <?php  $ia=$ia+1; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>   
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="addPartnership">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Indicate Partnerships</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
            <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-experience%2Fpartnership&id='.$_GET['id'],]) ?>
              <?php $model = new MgfPartnership();?>
                <?= $form->field($model, 'partner_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'partnership_aim')->textInput(['maxlength' => true]) ?>
                
                <?= $form->field($model, 'start_date')->widget(DatePicker::className(),
                ['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?>

                <?= $form->field($model, 'end_date')->widget(DatePicker::className(),
                ['pluginOptions' => ['autoclose'=>true,'format' => 'yyyy-mm-dd']]);?>

                <?= $form->field($model, 'partnership_status')->dropDownList([ 'On-Going' => 'On-Going', 'Completed' => 'Completed' ], ['prompt' => 'SELECT','required'=>true]) ?>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="addedPartnerships">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><h3>Partnerships</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Partner Name</th>
                                <th scope="col">Partnership Aim</th>
                                <th scope="col">Status</th>             
                            </tr>
                        </thead>
                        <tbody>
                            <?php  $ia=1; ?>
                                <?php foreach($partnerships as $part):?>
                                    <tr class="table-active">
                                        <th scope="row"><?=$ia; ?></th>
                                        <td><?=$part->partner_name; ?></td>
                                        <td><?=$part->partnership_aim; ?></td>
                                        <td><?=$part->partnership_status; ?></td>
                                    </tr>
                                <?php  $ia=$ia+1; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>   
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



