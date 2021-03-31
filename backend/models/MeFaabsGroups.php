<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "me_faabs_groups".
 *
 * @property int $id
 * @property int $camp_id
 * @property string $name
 * @property string $code
 * @property int|null $status
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property MeFaabsCategoryAFarmers[] $meFaabsCategoryAFarmers
 * @property Camp $camp
 * @property MeFaabsRegister[] $meFaabsRegisters
 * @property MeFaabsTrainingAttendanceSheet[] $meFaabsTrainingAttendanceSheets
 */
class MeFaabsGroups extends \yii\db\ActiveRecord {

    public $province_id;
    public $district_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_faabs_groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['camp_id', 'name'], 'required'],
            [['camp_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            ['name', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name') &&
                            empty($model->camp_id) ? TRUE : FALSE;
                }, 'message' => 'FaaBS name already exist!'],
            ['name', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name') && !empty(self::findOne(['name' => $model->name, "camp_id" => $model->camp_id])) ? TRUE : FALSE;
                }, 'message' => 'FaaBS already exist for this camp!'],
            [['code'], 'string', 'max' => 20],
            [['province_id', 'district_id'], 'safe'],
            ['code', 'unique', 'message' => 'FaaBS code already exist!'],
            [['camp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Camps::className(), 'targetAttribute' => ['camp_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'camp_id' => 'Camp',
            'name' => 'Name',
            'code' => 'Code',
            'status' => 'Status',
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
     * Gets query for [[MeFaabsCategoryAFarmers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeFaabsCategoryAFarmers() {
        return $this->hasMany(MeFaabsCategoryAFarmers::className(), ['faabs_group_id' => 'id']);
    }

    /**
     * Gets query for [[Camp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCamp() {
        return $this->hasOne(Camps::className(), ['id' => 'camp_id']);
    }

    /**
     * Gets query for [[MeFaabsRegisters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeFaabsRegisters() {
        return $this->hasMany(MeFaabsRegister::className(), ['faabs_group_id' => 'id']);
    }

    /**
     * Gets query for [[MeFaabsTrainingAttendanceSheets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeFaabsTrainingAttendanceSheets() {
        return $this->hasMany(MeFaabsTrainingAttendanceSheet::className(), ['faabs_group_id' => 'id']);
    }

    public static function getNames() {
        $names = self::find()->Where(['status' => 1])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($names, 'name', 'name');
    }

    public static function getList() {
        $list = self::find()->Where(['status' => 1])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

    public static function getById($id) {
        $data = self::find()->where(['id' => $id])->one();
        return $data->name;
    }

    public static function getListByCampIds() {
        $list = [];
        $_camp_ids = [];
        $camp_ids = \backend\models\Camps::find()
                ->select(['id'])
                ->where(['district_id' => Yii::$app->user->identity->district_id])
               // ->andWhere(['status' => 1])
                ->asArray()
                ->all();
        if (!empty($camp_ids)) {
            foreach ($camp_ids as $id) {
                array_push($_camp_ids, $id['id']);
            }
        }

        $list = self::find()
                ->where(['IN', 'camp_id', $_camp_ids])
                ->andWhere(['status' => 1])
                ->orderBy(['name' => SORT_ASC])
                ->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

}
