<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "conf_hourly_rates".
 *
 * @property int $id
 * @property string $designation
 * @property string $salary_scale
 * @property float $rate Recommended Government daily rate per hour based on salary scale of job holder
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property ActivityTimeSheetsDistrictStaff[] $activityTimeSheetsDistrictStaff
 */
class HourlyRates extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'conf_hourly_rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['designation', 'salary_scale'], 'required'],
            [['rate'], 'number'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['designation'], 'string', 'max' => 45],
            [['salary_scale'], 'string', 'max' => 50],
            ['rate', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('rate') &&
                            !empty(self::findOne([
                                        'rate' => $model->rate,
                                        "designation" => $model->designation
                            ])) ? TRUE : FALSE;
                }, 'message' => 'Rate already exist for designation!'],
            ['designation', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('designation') &&
                            !empty(self::findOne([
                                        'rate' => $model->rate,
                                        "designation" => $model->designation
                            ])) ? TRUE : FALSE;
                }, 'message' => 'Rate already exist for designation!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'designation' => 'Designation',
            'salary_scale' => 'Salary scale',
            'rate' => 'Rate',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * Gets query for [[ActivityTimeSheetsDistrictStaff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActivityTimeSheetsDistrictStaff() {
        return $this->hasMany(ActivityTimeSheetsDistrictStaff::className(), ['rate_id' => 'id']);
    }

     public static function getDesignations() {
      $names = self::find()->orderBy(['designation' => SORT_ASC])->all();
      return ArrayHelper::map($names, 'designation', 'designation');
      }
     public static function getSalaryScales() {
      $names = self::find()->orderBy(['salary_scale' => SORT_ASC])->all();
      return ArrayHelper::map($names, 'salary_scale', 'salary_scale');
      }

      public static function getList() {
      $list = self::find()->orderBy(['name' => SORT_ASC])->all();
      return ArrayHelper::map($list, 'id', 'name');
      }

      public static function getById($id) {
      $data = self::find()->where(['id' => $id])->one();
      return $data->name;
      } 
}
