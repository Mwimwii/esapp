<?php
use kartik\tabs\TabsX;
use yii\helpers\Url;

?>
 <?php
$items = [
    [
        'label'=>'<i class="fas fa-back"></i> back',
        'content'=>$content1,
        'active'=>true,
        'linkOptions'=>['data-url'=>Url::to(['mgf-applicant/profile'])]
    ],
    [
        'label'=>'<i class="fas fa-user"></i> Profile',
        'content'=>'is',//$content2,
        'linkOptions'=>['data-url'=>Url::to(['mgf-applicant/profile'])]
    ],
    [
        'label'=>'<i class="fas fa-list-alt"></i> Menu',
        'items'=>[
             [
                 'label'=>'<i class="fas fa-chevron-right"></i> Option 1',
                 'encode'=>false,
                 'content'=>'Lord',//$content3,
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
             ],
             [
                 'label'=>'<i class="fas fa-chevron-right"></i> Option 2',
                 'encode'=>false,
                 'content'=>'!',//$content4,
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
             ],
        ],
    ],
];
// Ajax Tabs Above
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'encodeLabels'=>false
]);
/* // Ajax Tabs Below
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_BELOW,
    'encodeLabels'=>false
]);
// Ajax Tabs Left
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_LEFT,
    'encodeLabels'=>false
]);
// Ajax Tabs Right
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_RIGHT,
    'encodeLabels'=>false
]); */
?>