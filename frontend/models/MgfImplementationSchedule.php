<?php

namespace frontend\models;

use Yii;
<<<<<<< HEAD
use yii\data\ArrayDataProvider;
=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

/**
 * This is the model class for table "mgf_implementation_schedule".
 *
 * @property int $id
 * @property int|null $activity_id
 * @property int|null $yr1qtr1
 * @property int|null $yr1qtr2
 * @property int|null $yr1qtr3
 * @property int|null $yr1qtr4
 * @property int|null $yr2qtr1
 * @property int|null $yr2qtr2
 * @property int|null $yr2qtr3
 * @property int|null $yr2qtr4
 * @property int|null $yr3qtr1
 * @property int|null $yr3qtr2
 * @property int|null $yr3qtr3
 * @property int|null $yr3qtr4
 * @property int|null $yr4qtr1
 * @property int|null $yr4qtr2
 * @property int|null $yr4qtr3
 * @property int|null $yr4qtr4
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 */
class MgfImplementationSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_implementation_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_id', 'yr1qtr1', 'yr1qtr2', 'yr1qtr3', 'yr1qtr4', 'yr2qtr1', 'yr2qtr2', 'yr2qtr3', 'yr2qtr4', 'yr3qtr1', 'yr3qtr2', 'yr3qtr3', 'yr3qtr4', 'yr4qtr1', 'yr4qtr2', 'yr4qtr3', 'yr4qtr4', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['proposal_id', 'created_by'], 'required'],
            [['date_created', 'date_update'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => 'Activity Name',
            'yr1qtr1' => '',
            'yr1qtr2' => '',
            'yr1qtr3' => '',
            'yr1qtr4' => '',
            'yr2qtr1' => '',
            'yr2qtr2' => '',
            'yr2qtr3' => '',
            'yr2qtr4' => '',
            'yr3qtr1' => '',
            'yr3qtr2' => '',
            'yr3qtr3' => '',
            'yr3qtr4' => '',
            'yr4qtr1' => '',
            'yr4qtr2' => '',
            'yr4qtr3' => '',
            'yr4qtr4' => '',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
<<<<<<< HEAD

class GanttTest extends \yii\base\Model
{
  public function getDataProvider()
  {
      $testArray = [
        [
          'task' => 'Project planing',
          'type' => 'primary',
          'START_DATE' => '2020-10-19',
          'END_DATE' => '2020-11-07'
        ],
        [
          'task' => 'Production',
          'type' => 'danger',
          'START_DATE' => '2020-11-15',
          'END_DATE' => '2021-03-29'
        ],
        [
          'task' => 'Release',
          'type' => 'success',
          'START_DATE' => '2021-04-05',
          'END_DATE' => '2021-04-06'
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
=======
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
