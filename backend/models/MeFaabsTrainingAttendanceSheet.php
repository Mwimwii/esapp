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
    public $year;

    //These are needed for reports "Facilitation of Improved Technologies/Best Practices";
    const indicator_one = 'Number of smallholders trained in the use of improved production technologies & best practices to enhance productivity that allow production to comply with market requirements (at least 3 improved production technologies facilitated)';
    const indicator_two = 'Number of smallholders trained in improved Post-harvest technologies (at least 2 improved post-harvest technologies)';
    const indicator_three = 'Number of smallholders who have been trained in improved pre- and Post-harvest technologies (at least 2 improved post-harvest technologies) to minimize losses and increase market value of their produce';
    const indicator_four = 'Number of producer organizations/cooperatives/marketing groups established or strengthened [Strengthening of coordination & business models]';
    const indicator_five = 'Number of smallholder producers (desegregated by gender) in organizations/cooperatives/marketing groups trained in crucial aspects for inclusion in VC i.e. identification of partnership opportunities, negotiation, market linkages, business management, governance etc [Strengthening of coordination & business models]';
    const indicator_six = 'Number of local service providers (farm & non-farm) strengthened and/or trained to provide services that allow production to meet market requirements [Strengthening of coordination & business models]';
    const indicator_seven = 'C..1.8 Number of Households reached with targeted support to improve their nutrition';

    // public $quarter;

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
            [['faabs_group_id', 'farmer_id', 'topic', 'facilitators', 'training_date', 'duration','training_type'], 'required'],
            [['faabs_group_id', 'farmer_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            //Needed for validation since Loading Post request returns all strings
            //and 'isAttributeChanged' will treat integers that in string formart
            //as changed i.e. when checking uniqueness of the submitted farmer farmer
            //record below, on update, the uniqueness applies because farmer_id is returned as string
            //when its suppose to be an int, therefore isAttibutedChanged thinks the id changed
            //Hence this filter to cast to integer 
            [['farmer_id', 'faabs_group_id'], 'filter', 'filter' => 'intval'],
            [['topic', 'facilitators', 'partner_organisations'], 'string'],
            [['household_head_type'], 'string', 'max' => 45],
            [['duration'], 'string', 'max' => 10],
            [['province_id', 'district_id', 'camp_id', 'training_date','year', 'quarter','topic_indicator','topic_subcomponent','training_type'], 'safe'],
            ['farmer_id', 'unique', 'when' => function($model) {
                    return $this->isAttributeChanged('farmer_id') && !empty(self::findOne(['farmer_id' => $model->farmer_id, "training_date" => $model->training_date, "topic" => $model->topic,"faabs_group_id" => $model->faabs_group_id]));
                }, 'message' => 'FaaBS training attendance is already submtted for this farmer for the entered training date and topic!'
            ],
            ['topic', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('topic') && !empty(self::findOne(['farmer_id' => $model->farmer_id, "training_date" => $model->training_date, "topic" => $model->topic,"faabs_group_id" => $model->faabs_group_id])) ? TRUE : FALSE;
                }, 'message' => 'FaaBS training attendance is already submtted for this farmer for the entered training date and topic!'
            ],
            ['training_date', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('training_date') && !empty(self::findOne(['farmer_id' => $model->farmer_id, "training_date" => $model->training_date, "topic" => $model->topic,"faabs_group_id" => $model->faabs_group_id])) ? TRUE : FALSE;
                }, 'message' => 'FaaBS training attendance is already submtted for this farmer for the entered training date and topic!'
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
            'training_type' => 'Training type',
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

    public static function getQuarter($month) {
        $quarter = "";
        if (in_array($month, [1, 2, 3])) {
            $quarter = 1;
        }
        if (in_array($month, [4, 5, 6])) {
            $quarter = 2;
        }
        if (in_array($month, [7, 8, 9])) {
            $quarter = 3;
        }
        if (in_array($month, [10, 11, 12])) {
            $quarter = 4;
        }
        return $quarter;
    }

}
