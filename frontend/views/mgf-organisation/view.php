<?php

use backend\models\Districts;
use frontend\models\MgfApplicant;
use frontend\models\MgfBranch;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use frontend\models\MgfPosition;
use kartik\form\ActiveForm;
use frontend\models\MgfContact;

/* @var $this yii\web\View */
/* @var $model frontend\models\MgfOrganisation */

$this->title = "Profile of the Organisation";
$usertype=Yii::$app->user->identity->type_of_user;
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-9">
        <h3><?= Html::encode($this->title); ?></h3>
          <?= DetailView::widget([
              'model' => $model,
              'attributes' => [
                  ['label' => 'Organisation','value' => $model->cooperative],
                  'acronym',
                  'registration_type',
                  'registration_no',
                  'trade_license_no',
                  'registration_date',
                  'business_objective:ntext',
                  'email_address:email',
                  'physical_address',
                  'tel_no',
                  'fax_no',
                  ['label' => 'Applicant','value' => $model->applicant->first_name." ".$model->applicant->last_name,],
                  'date_created',
                ],
            ]) ?>

          <?php if($usertype=="Applicant"){ ?>
              <?= Html::a('<i class="fa fa-home"></i>Home', ['/mgf-applicant/profile'],['class' => 'btn btn-default']),
              Html::a('<i class="glyphicon glyphicon-edit"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
          <?php }else{ ?>
              <?= Html::a('<i class="fa fa-backward"></i>Back', ['index'],['class' => 'btn btn-default'])?>
          <?php } ?>
        </div>

    <div class="col-md-1">
    </div>
</div>


<h4>Contact Details</h4>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Mobile No.</th>
            <th scope="col">Position</th>
            <th scope="col">
              <?php if(MgfContact::find()->where(['organisation_id'=>$_GET['id']])->count()<2) {
                echo Html::button('<i class="fa fa-plus"></i>New Contact', [ 'class' => 'btn btn-success btn-sm', 'onclick' => '$(\'#addContantact\').modal();']);
              }else{echo 'Action';}?>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($contacts)>0): ?>
          <?php  $i=1; ?>
          <?php foreach($contacts as $post):?>
          <tr class="table-active">
            <th scope="row"><?=$i; ?></th>
            <td><?=$post->first_name; ?></td>
            <td><?=$post->last_name; ?></td>
            <td><?=$post->mobile; ?></td>
            <td><?=$post->position->position; ?></td>
            <td>
              <span><?=Html::a('<i class="fa fa-edit"></i>Edit',['mgf-contact/update','id'=>$post->id],['class'=>'btn btn-primary btn-sm'])?></span> 
              <?= Html::a('<i class="fa fa-trash"></i>Delete', ['mgf-contact/delete', 'id' => $post->id], ['class' => 'btn btn-danger btn-sm','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
            </td>
          </tr>
          <?php  $i=$i+1; ?>
          <?php endforeach; ?>
            <?php else:?>
              <tr>
                  <td>No Records Found</td>
              </tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>

<br/><br/>
<?php if($model->organisational_branches==1){?>

<h4> <?=$model->cooperative;?> Branches </h4>
<div class="card-body">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Location</th>
        <th scope="col">District</th>
        <th scope="col">Number of Employees</th>
        <th scope="col">
          <?php echo Html::button('<i class="fa fa-plus"></i>Add Branch', [ 'class' => 'btn btn-success btn-sm', 'onclick' => '$(\'#addBranch\').modal();']);?>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($branches)>0): ?>
      <?php  $i=1; ?>
      <?php foreach ($branches as $post):?>
      <tr class="table-active">
        <th scope="row"><?=$i; ?></th>
        <td><?=$post->address; ?></td>
        <td><?=$post->district->name; ?></td>
        <td><?=$post->employess; ?></td>
        <td>
          <span><?=Html::a('<i class="fa fa-edit"></i>Edit', ['mgf-organisation/updatebranch','id'=>$post->id], ['class'=>'btn btn-primary btn-sm'])?></span> 
          <?= Html::a('<i class="fa fa-trash"></i>Delete', ['mgf-organisation/deletebranch', 'id' => $post->id], ['class' => 'btn btn-danger btn-sm','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
        </td>
      </tr>
      <?php  $i=$i+1; ?>
      <?php endforeach; ?>
        <?php else:?>
          <tr>
              <td>No Records Found</td>
          </tr>
        <?php endif; ?>
    </tbody>
  </table>
</div>


<div class="modal fade" id="addBranch">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Create Branch</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> 
        <div class="modal-body">
          <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-organisation/createbranch&id='.$model->id,]) ?>
          <?php $orgid = $model->id;?>
          <?php $model = new MgfBranch();?>
            <?= $form->field($model, 'address')->textarea(['maxlength' => true]) ?>
            <?= $form->field($model, 'employess')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'district_id')->dropDownList(ArrayHelper::map(Districts::find()->all(), 'id', 'name'), ['prompt'=>'District'])?>              
        </div>
        <div class="modal-footer">
            <?= Html::submitButton('<i class="fa fa-check"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
</div>

<?php } ?>

    <div class="modal fade" id="addContantact">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Create Contact Person</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> 
            <div class="modal-body">
            <?php $userid=Yii::$app->user->identity->id;?>
            <?php $applicant=MgfApplicant::findOne(['user_id'=>$userid]);?>
              <?php $form = ActiveForm::begin(['action' => 'index.php?r=mgf-contact%2Fcreate&id='.$applicant->id,]) ?>
              <?php $orgid = $model->id;?>
              <?php $model = new MgfContact();?>
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'tel_no')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'physical_address')->textarea(['maxlength' => true]) ?>

                <?php if (MgfContact::find()->where(['organisation_id'=>$orgid])->exists()){;?>
                  <?php $count = MgfContact::find()->where(['organisation_id'=>$orgid])->count();?>
                    <?php if($count==1){?>
                        <?php $contact = MgfContact::findOne(['organisation_id'=>$orgid]);?>
                                                      
                        <?php if($contact->position->position=='Board Chairman'){?>
                            <?= $form->field($model, 'position_id')->dropDownList(ArrayHelper::map(MgfPosition::find()->where(['position'=>'CEO'])->all(), 'id', 'position'), ['prompt'=>'Position'])?>
                        <?php }else{ ?>
                          <?= $form->field($model, 'position_id')->dropDownList(ArrayHelper::map(MgfPosition::find()->where(['position'=>'Board Chairman'])->all(), 'id', 'position'), ['prompt'=>'Position'])?>
                      <?php } ?>   
                    
                    <?php } ?>
                
                <?php }else{ ?>
                
                  <?= $form->field($model, 'position_id')->dropDownList(ArrayHelper::map(MgfPosition::find()->all(), 'id', 'position'), ['prompt'=>'Position'])?>
                
                <?php } ?>

            </div>
            <div class="modal-footer">
                <?= Html::submitButton('<i class="fa fa-check"></i>Save ', ['class' => 'btn btn-success btn-sm']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>


    




