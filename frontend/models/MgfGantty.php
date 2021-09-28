<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;

class MgfGantty extends \yii\base\Model
{
  /* public  static function getDBData(){
    $data=self::find()
    ->where(["id"=>1])
    ->andWhere([])
    ->all()
    ->asArray();

    $t=[];
    foreach($data as $model){
      
    }
return [
[],[]
]; */
 // }
  public static function getDataProvider()
  {
   // $testArray= getDBData();
      $testArray = [
        [
          'task' => 'Project planing',
          'type' => 'primary',
          'year'=>'1',
          'Qtr'=>'1',
          'START_DATE' => '2020-10-19',
          'END_DATE' => '2020-11-07'
        ],
        [
          'task' => 'Production',
          'type' => 'success',
          'year'=>'1',
          'Qtr'=>'2',
          'START_DATE' => '2020-11-15',
          'END_DATE' => '2021-03-29'
        ],
        [
          'task' => 'Release',
          'type' => 'success',
          'year'=>'1',
          'Qtr'=>'3',
          'START_DATE' => '2020-04-05',
          'END_DATE' => '2020-04-06'
        ],
      ];
     return new ArrayDataProvider([
          'allModels' => $testArray,
          'pagination' => [
              'pageSize' => 0,
          ],
        ]
      );
  }
}
?>