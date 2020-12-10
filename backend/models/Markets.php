<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "market".
 *
 * @property int $id
 * @property int $district_id
 * @property string $name
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property CommodityPriceCollection[] $commodityPriceCollections
 * @property District $district
 */
class Markets extends \yii\db\ActiveRecord {

    public $province_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'market';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['district_id', 'name'], 'required'],
            [['district_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
            [['province_id'], 'safe'],
            [['name'], 'string', 'max' => 255],
            ['name', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name') &&
                            empty($model->district_id) ? TRUE : FALSE;
                }, 'message' => 'Market name already exist!'],
            ['name', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name') && !empty(self::findOne(['name' => $model->name, "district_id" => $model->district_id])) ? TRUE : FALSE;
                }, 'message' => 'Market already exist for this district!'],
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
            'name' => 'Market name',
            'province_id' => "Province",
            'description' => 'Description',
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
     * Gets query for [[CommodityPriceCollections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommodityPriceCollections() {
        return $this->hasMany(CommodityPriceCollection::className(), ['market_id' => 'id']);
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict() {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
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

    public static function getByDistrict($id) {
        $list = self::find()->where(['district_id' => $id])->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

}
