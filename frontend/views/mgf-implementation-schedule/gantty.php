<?php
use kartik\grid\GridView;
use frontend\models\MgfGantty;
echo GridView::widget([
  'dataProvider' => MgfGantty::getDataProvider(),
  'columns' => [
    [
      'attribute' => 'task',
      'options' => ['style' => 'width:200px;'],
    ],
    [
      'attribute' => 'year',
      'options' => ['style' => 'width:50px;'],
    ],
    [
      'attribute' => 'Qtr',
      'options' => ['style' => 'width:50px;'],
    ],
    [
      'attribute' => 'gantChart',
      'class' => 'rottriges\ganttcolumn\GanttColumn',
      'ganttOptions' => [
        // start or endDateRange can either be a static date (Y-m-d)
        // or an offset in weeks to the current date (-2, 0, 5, ...)
         'dateRangeStart' => '2020-01-31',
         'dateRangeEnd' => '2020-12-31',
       
      //  'dateRangeStart' => -4,
        //'dateRangeEnd' => 28,
        'startAttribute' => 'START_DATE',
        'endAttribute' => 'END_DATE',
        // progressBarType [string | closure] possible values
        // primary, info, warning or danger.
        'progressBarType' => function($model, $key, $index) {
          return $model['type'];
        },
        // progressBarColor [string | closure]
        // css color property
        // if color is set progressbar type will be overwritten
        'progressBarType' => function($model, $key, $index) {
          return $model['type'];
        }
      ]
    ],
  ],
]);
?>