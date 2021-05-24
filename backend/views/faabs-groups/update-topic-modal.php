<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\touchspin\TouchSpin;
?>
<?php
$form = ActiveForm::begin([
            'action' => 'update-topics?id=' . $id,
            'type' => ActiveForm::TYPE_VERTICAL
        ])
?>
<div class="row">
    <div class = "col-md-12">
        <ol>
            <li>Fields marked with <span class="text-red">*</span> are required</li>
            <li>You can pick multiple topics from the list</li>
        </ol>


        <?=
                $form->field($model, "training_type")
                ->dropDownList(
                        [
                            'Participants under Direct/Intensive Training [Stream 1]' => "Participants under Direct/Intensive Training [Stream 1]",
                            "Participants under non-Direct/Other Training [Stream 2]" => "Participants under non-Direct/Other Training [Stream 2]"
                        ], ['custom' => true, 'prompt' => 'Select training type', 'required' => true]
                )->label("Training type");
        ?>

        <?php
        echo $form->field($model, 'topics')->multiselect(\backend\models\MeFaabsTrainingTopics::getList(), [
            'height' => "auto"
        ])->label("Topics");
        ?>
    </div>
    <div class = "col-md-12">
        <hr class = "dotted"/>
<?= Html::submitButton('Update topics', ['class' => 'btn btn-success btn-xs']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
