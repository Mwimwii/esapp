<?php

use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use kartik\editable\Editable;
use backend\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'AWPB';
$this->params['breadcrumbs'][] = "Reports";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-success card-outline">
    <div class="card-body">
        <h4>Instructions</h4>
        <ol>
            <li>Apply a filter below to view a budget</li>
            <?php
//            if (empty(Yii::$app->user->identity->district_id)) {
//                echo '<li>Province and Training type are mandatory before you can filter</li>';
//            }
//            if (isset($_GET['MeFaabsTrainingAttendanceSheetSearch'])) {
//                echo '<li>Click the "<span class="badge badge-success"><span class="fas fa-file-excel"></span> Download report</span>" button to download the report</li>';
//            }
            ?>
        </ol>
       

    </div>
</div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

