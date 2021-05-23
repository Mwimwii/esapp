<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use borales\extensions\phoneInput\PhoneInputValidator;

/**
 * This is the model class for table "me_faabs_category_a_farmers".
 *
 * @property int $id
 * @property int $faabs_group_id
 * @property string $first_name
 * @property string|null $other_names
 * @property string $last_name
 * @property string $sex
 * @property string $dob
 * @property string|null $nrc
 * @property string $marital_status
 * @property string|null $contact_number
 * @property string|null $relationship_to_household_head
 * @property string $registration_date
 * @property int $status
 * @property int|null $household_size
 * @property string|null $village
 * @property string|null $chiefdom
 * @property string|null $block
 * @property string|null $zone
 * @property string|null $commodity
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property MeFaabsGroups $faabsGroup
 * @property MeFaabsRegister[] $meFaabsRegisters
 * @property MeFaabsTrainingAttendanceSheet[] $meFaabsTrainingAttendanceSheets
 */
class MeFaabsCategoryAFarmers extends \yii\db\ActiveRecord {

    public $province_id;
    public $district_id;
    public $camp_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_faabs_category_a_farmers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['title', 'faabs_group_id', 'first_name', 'last_name', 'sex', 'dob', 'marital_status', 'registration_date', 'nrc'], 'required'],
            [['faabs_group_id', 'status', 'household_size', 'created_at', 'updated_at', 'created_by', 'updated_by','age'], 'integer'],
            [['dob', 'registration_date'], 'safe'],
            [['first_name', 'other_names', 'last_name', 'village', 'chiefdom', 'block', 'zone', 'commodity'], 'string', 'max' => 255],
            [['sex'], 'string', 'max' => 7],
            [['nrc', 'title'], 'string', 'max' => 20],
            ['nrc', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('nrc');
                }, 'message' => 'NRC already in use!'],
            [['marital_status'], 'string', 'max' => 15],
            [['province_id', 'district_id', 'camp_id','household_head_type'], 'safe'],
            //[['contact_number'], 'string', 'max' => 16],
            [['contact_number'], PhoneInputValidator::className()],
            [['relationship_to_household_head'], 'string', 'max' => 50],
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
            'first_name' => 'First name',
            'other_names' => 'Other names',
            'last_name' => 'Last name',
            'sex' => 'Sex',
            'dob' => 'Dob',
            'age' => 'Age',
            'nrc' => 'NRC',
            'marital_status' => 'Marital status',
            'contact_number' => 'Contact No.',
            'household_head_type' => 'HH head type',
            'relationship_to_household_head' => 'Relationship to HH head',
            'registration_date' => 'Registration Date',
            'status' => 'Status',
            'household_size' => 'Household size',
            'village' => 'Village',
            'chiefdom' => 'Chiefdom',
            'block' => 'Block',
            'zone' => 'Zone',
            'commodity' => 'Commodity',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[FaabsGroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaabsGroup() {
        return $this->hasOne(MeFaabsGroups::className(), ['id' => 'faabs_group_id']);
    }

    /**
     * Gets query for [[MeFaabsRegisters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeFaabsRegisters() {
        return $this->hasMany(MeFaabsRegister::className(), ['farmer_id' => 'id']);
    }

    /**
     * Gets query for [[MeFaabsTrainingAttendanceSheets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeFaabsTrainingAttendanceSheets() {
        return $this->hasMany(MeFaabsTrainingAttendanceSheet::className(), ['farmer_id' => 'id']);
    }

    public static function getFullNames() {
        $query = static::find()
                ->select(["CONCAT(CONCAT(CONCAT(title,' ',first_name),' ',other_names),' ',last_name) as name", 'first_name'])
                //->where(["IN", 'status', [self::STATUS_ACTIVE]])
                ->orderBy(['id' => SORT_ASC])
                ->asArray()
                ->all();

        return \yii\helpers\ArrayHelper::map($query, 'first_name', 'name');
    }

    public static function getActiveFarmers() {
        $_camp_ids = [];
        $_faabs_ids = [];
        $camp_ids = \backend\models\Camps::find()
                ->select(['id'])
                ->where(['district_id' => Yii::$app->user->identity->district_id])
                ->asArray()
                ->all();
        if (!empty($camp_ids)) {
            foreach ($camp_ids as $id) {
                array_push($_camp_ids, $id['id']);
            }
        }

        $list = \backend\models\MeFaabsGroups::find()
                ->where(['IN', 'camp_id', $_camp_ids])
                ->andWhere(['status' => 1])
                ->asArray()
                ->all();

        if (!empty($list)) {
            foreach ($list as $id) {
                array_push($_faabs_ids, $id['id']);
            }
        }

        $query = static::find()
                ->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_names),' ',last_name) as name", 'id'])
                ->where(['status' => 1])
                ->andWhere(['IN', 'faabs_group_id', $_faabs_ids])
                ->orderBy(['id' => SORT_ASC])
                ->asArray()
                ->all();
        return ArrayHelper::map($query, 'id', 'name');
    }

    public static function getList() {
        $query = static::find()
                ->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_names),' ',last_name) as name", 'id'])
                ->where(['status' => 1])
                ->orderBy(['id' => SORT_ASC])
                ->asArray()
                ->all();
        return ArrayHelper::map($query, 'id', 'name');
    }

}
