<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LogframeMgfSupportedAgribusiness */

$this->title = 'Add Record';
$this->params['breadcrumbs'][] = ['label' => 'Logframe / Output Value of Investments MGF supported records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>

    </div>
</div>