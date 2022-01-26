<?php

namespace backend\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "logframe_deve_objectives_household_profitableproject_support".
 *
 * @property int $id
 * @property string $year
 * @property string $indicator
 * @property string $yr_target
 * @property string $yr_results
 * @property string $category
 * @property string $cumulative
 * @property string $cumulative_percentage
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class LogframeDeveObjectivesHouseholdProfitableprojectSupport extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'logframe_deve_objectives_household_profitableproject_support';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['year', 'indicator', 'yr_target', 'yr_results', 'category', 'cumulative', 'cumulative_percentage'], 'required'],
            [['indicator'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['year'], 'string', 'max' => 5],
            ['year', 'unique', 'when' => function ($model) {
                    return $model->isAttributeChanged('year') &&
                    !empty(self::findOne([
                                'year' => $model->year,
                                'category' => $model->category])) ? TRUE : FALSE;
                }, 'message' => 'Record already exist for the selected Year and Category. Please modify the existing record!'],
            ['category', 'unique', 'when' => function ($model) {
                    return $model->isAttributeChanged('category') &&
                    !empty(self::findOne([
                                'year' => $model->year,
                                'category' => $model->category
                            ])) ? TRUE : FALSE;
                }, 'message' => 'Record already exist for the selected Category and Year. Please modify the existing record!'],
            [['yr_target', 'yr_results', 'category', 'cumulative', 'cumulative_percentage'], 'safe'],
        ];
    }

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
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'year' => 'Year',
            'indicator' => 'Indicator',
            'yr_target' => 'Yr Target',
            'yr_results' => 'Yr Results',
            'category' => 'Category',
            'cumulative' => 'Cumulative',
            'cumulative_percentage' => '% Cum',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

}
