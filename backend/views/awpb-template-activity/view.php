<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AwpbTemplateActivity */

<<<<<<< HEAD
$this->title = $model->id;
=======
$this->title = $model->name;
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
$this->params['breadcrumbs'][] = ['label' => 'Awpb Template Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="awpb-template-activity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'activity_id',
<<<<<<< HEAD
=======
            'activity_code',
            'name',
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
            'component_id',
            'outcome_id',
            'output_id',
            'awpb_template_id',
            'funder_id',
            'expense_category_id',
<<<<<<< HEAD
=======
            'ifad',
            'ifad_grant',
            'grz',
            'beneficiaries',
            'private_sector',
            'iapri',
            'parm',
            'access_level_district',
            'access_level_province',
            'access_level_programme',
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
