<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title="Add Final Comment";
?>
<h3><?= Html::encode($this->title)?></h3>

<?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>