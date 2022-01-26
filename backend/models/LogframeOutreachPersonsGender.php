<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "logframe_outreach_persons_gender".
 *
 * @property int $id
 * @property string $year
 * @property string $indicator
 * @property string $baseline
 * @property string $mid_term
 * @property string $yr_target
 * @property string $yr_results
 * @property string $gender
 * @property string $cumulative
 * @property string $cumulative_percentage
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 */
class LogframeOutreachPersonsGender extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'logframe_outreach_persons_gender';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['year', 'indicator','yr_target', 'yr_results', 'gender', 'cumulative', 'cumulative_percentage'], 'required'],
            [['indicator'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['year'], 'string', 'max' => 5],
            ['year', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('year') &&
                            !empty(self::findOne(['year' => $model->year,
                                        "gender" => $model->gender])) ? TRUE : FALSE;
                }, 'message' => 'Record already exist for the selected year and gender. Please modify the existing record!'],
            ['gender', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('gender') &&
                            !empty(self::findOne(['year' => $model->year,
                                        "gender" => $model->gender])) ? TRUE : FALSE;
                }, 'message' => 'Record already exist for the selected gender and year. Please modify the existing record!'],
            [['yr_target', 'yr_results', 'gender', 'cumulative', 'cumulative_percentage'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'id',
            'year' => 'Year',
            'indicator' => 'Indicator',
            'yr_target' => 'Yr target',
            'yr_results' => 'Yr results',
            'gender' => 'Gender',
            'cumulative' => 'Cum',
            'cumulative_percentage' => '% Cum',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
            'created_by' => 'Created by',
            'updated_by' => 'Updated by',
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

}
