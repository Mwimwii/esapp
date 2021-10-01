<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "logframe_programme_targets".
 *
 * @property int $id
 * @property string $baseline
 * @property string $mid_term
 * @property string|null $end_target
 * @property string $record_type
 * @property string|null $indicator
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class LogframeProgrammeTargets extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'logframe_programme_targets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['baseline', 'mid_term', 'record_type','end_target'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['baseline', 'mid_term', 'end_target'], 'string', 'max' => 45],
            [['record_type', 'indicator', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'baseline' => 'Baseline',
            'mid_term' => 'Mid Term',
            'end_target' => 'End Target',
            'record_type' => 'Record Type',
            'indicator' => 'Indicator',
            'description' => 'Description',
//            'created_at' => 'Created At',
//            'updated_at' => 'Updated At',
//            'created_by' => 'Created By',
//            'updated_by' => 'Updated By',
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
