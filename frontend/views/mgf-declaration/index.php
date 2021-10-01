<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MgfDeclarationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mgf Declarations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mgf-declaration-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mgf Declaration', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'declaration_parta',
            'declaration_partb',
            'declaration_partc',
            'rep_name',
            //'rep_aproval',
            //'approval_date',
            //'rep_title',
            //'address',
            //'phone',
            //'email:email',
            //'project_id',
            //'date_created',
            //'date_update',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
