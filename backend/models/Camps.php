<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "camp".
 *
 * @property int $id
 * @property int $district_id
 * @property string $name
 * @property string|null $description
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property District $district
 * @property CommodityPriceCollection[] $commodityPriceCollections
 */
class Camps extends \yii\db\ActiveRecord {

    public $province_id;
    public $coordinates;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'camp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['district_id', 'name'], 'required'],
            [['district_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['description','longitude', 'latitude'], 'string'],
            [['province_id','coordinates'], 'safe'],
            [['name'], 'string', 'max' => 255],
            ['name', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name') &&
                            empty($model->district_id) ? TRUE : FALSE;
                }, 'message' => 'Camp name already exist!'],
            ['name', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name') &&
                            !empty(self::findOne([
                                        'name' => $model->name,
                                        "district_id" => $model->district_id
                            ])) ? TRUE : FALSE;
                }, 'message' => 'Camp name already exist for this district!'],
            [['latitude', 'longitude'], 'string', 'max' => 30],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'district_id' => 'District',
            'name' => 'Camp name',
            'description' => 'Description',
            'province_id' => 'Province',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
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
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict() {
        return $this->hasOne(Districts::className(), ['id' => 'district_id']);
    }

    /**
     * Gets query for [[CommodityPriceCollections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommodityPriceCollections() {
        return $this->hasMany(CommodityPriceCollection::className(), ['camp_id' => 'id']);
    }

    public static function getNames() {
        $names = self::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($names, 'name', 'name');
    }

    public static function getList() {
        $list = self::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

    public static function getById($id) {
        $data = self::find()->where(['id' => $id])->one();
        return $data->name;
    }

    public static function getListByDistrictId($id) {
        $list = self::find()->where(['district_id' => $id])->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

    public static function getListByDistrictId2($id) {
        //We get camps by district and whose monthly plan has not yet been set
        $_arr = [];
        $work_effor_list = MeCampSubprojectRecordsPlannedWorkEffort::find()
                ->select(['camp_id'])
                ->where(['year' => date('Y'), 'month' => date('n')])
                ->all();
        if (!empty($work_effor_list)) {
            foreach ($work_effor_list as $value) {
                array_push($_arr, $value['camp_id']);
            }
        }

        $list = self::find()
                ->where(['district_id' => $id])
                ->andWhere(['NOT IN', "id", $_arr])
                ->orderBy(['name' => SORT_ASC])
                ->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

}
