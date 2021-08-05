<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "me_quarterly_outreach_records".
 *
 * @property int $id
 * @property string $component
 * @property string $sub_component
 * @property int $province_id
 * @property int $district_id
 * @property string $year
 * @property int $quarter
 * @property int $number_females
 * @property int $number_males
 * @property int $number_young
 * @property int $number_not_young
 * @property int $number_women_headed_households
 * @property int $number_households
 * @property int $number_household_members
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class ProjectOutreach extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_quarterly_outreach_records';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['component', 'sub_component', 'year', 'quarter'], 'required'],
            [['component', 'sub_component'], 'string'],
            [['province_id', 'district_id', 'quarter', 'number_females', 'number_males', 'number_young', 'number_not_young', 'number_women_headed_households','number_non_women_headed_households', 'number_households', 'number_household_members', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['year'], 'string', 'max' => 5],
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
            'component' => 'Component',
            'sub_component' => 'Sub Component',
            'province_id' => 'Province',
            'district_id' => 'District',
            'year' => 'Year',
            'quarter' => 'Quarter',
            'number_females' => '#Females',
            'number_males' => '#Males',
            'number_young' => '#Young',
            'number_not_young' => '#Not young',
            'number_women_headed_households' => '#Women headed HH',
            'number_households' => '#Households',
            'number_household_members' => '#Household members',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

}
