<?php


use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;;
use kartik\editable\Editable;
use backend\models\User;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AwpbTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Awpb Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="awpb-template-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Awpb Template', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fiscal_year',
            'budget_theme:ntext',
            'comment:ntext',
            'guideline_file',
            //'status',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
