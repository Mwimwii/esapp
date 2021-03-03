<?php
	use yii\widgets\ActiveForm;
   
	use yii\helpers\Html;
	use yii\widgets\DetailView;
	use kartik\grid\GridView;
	use \backend\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplate */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'AWPB Templates Upload', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
<?= $form->field($model, 'image')->fileInput() ?>
   <button>Submit</button>
<?php ActiveForm::end() ?>