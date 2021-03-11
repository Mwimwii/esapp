<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "me_faabs_training_attendance_sheet".
 *
 * @property int $id
 * @property int $faabs_group_id
 * @property int $farmer_id
 * @property string $household_head_type Female headed or Male headed
 * @property string $topic Training course
 * @property string $facilitators Facilitators/Organisation
 * @property string|null $partner_organisations
 * @property string $training_date
 * @property string $duration Duration hours and minutes
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property MeFaabsCategoryAFarmers $farmer
 * @property MeFaabsGroups $faabsGroup
 */
class MeFaabsTrainingAttendanceSheet extends \yii\db\ActiveRecord {

    public $province_id;
    public $district_id;
    public $camp_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_faabs_training_attendance_sheet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['faabs_group_id', 'farmer_id', 'topic', 'facilitators', 'training_date', 'duration'], 'required'],
            [['faabs_group_id', 'farmer_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['topic', 'facilitators', 'partner_organisations'], 'string'],
            [['household_head_type'], 'string', 'max' => 45],
            [['duration'], 'string', 'max' => 10],
            [['province_id', 'district_id', 'camp_id', 'training_date'], 'safe'],
            ['farmer_id', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('farmer_id') && !empty(self::findOne(['farmer_id' => $model->farmer_id, "training_date" => $model->training_date, "faabs_group_id" => $model->faabs_group_id])) ? TRUE : FALSE;
                }, 'message' => 'FaaBS training attendance is already submtted for this farmer for the entered training date!'
            ],
            ['faabs_group_id', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('faabs_group_id') && !empty(self::findOne(['farmer_id' => $model->farmer_id, "training_date" => $model->training_date, "faabs_group_id" => $model->faabs_group_id])) ? TRUE : FALSE;
                }, 'message' => 'FaaBS training attendance is already submtted for this farmer for the entered training date!'
            ],
            ['training_date', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('training_date') && !empty(self::findOne(['farmer_id' => $model->farmer_id, "training_date" => $model->training_date, "faabs_group_id" => $model->faabs_group_id])) ? TRUE : FALSE;
                }, 'message' => 'FaaBS training attendance is already submtted for this farmer for the entered training date!'
            ],
            [['farmer_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeFaabsCategoryAFarmers::className(), 'targetAttribute' => ['farmer_id' => 'id']],
            [['faabs_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeFaabsGroups::className(), 'targetAttribute' => ['faabs_group_id' => 'id']],
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
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'faabs_group_id' => 'FaaBS group',
            'farmer_id' => 'Farmer',
            'household_head_type' => 'HH head type',
            'topic' => 'Topic',
            'facilitators' => 'Facilitators',
            'partner_organisations' => 'Partner organisations',
            'training_date' => 'Training date',
            'duration' => 'Duration',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Farmer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFarmer() {
        return $this->hasOne(MeFaabsCategoryAFarmers::className(), ['id' => 'farmer_id']);
    }

    /**
     * Gets query for [[FaabsGroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaabsGroup() {
        return $this->hasOne(MeFaabsGroups::className(), ['id' => 'faabs_group_id']);
    }

}
