<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use dosamigos\google\maps\LatLng;

/**
 * This is the model class for table "province".
 *
 * @property int $id
 * @property string|null $name
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property District[] $districts
 */
class Provinces extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'province';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            ['name', 'unique', 'message' => 'Province name exist already!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Province name',
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
     * Gets query for [[Districts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts() {
        return $this->hasMany(District::className(), ['province_id' => 'id']);
    }

    public static function getProvinceList() {
        $provinces = self::find()->orderBy(['name' => SORT_ASC])->all();
        $list = ArrayHelper::map($provinces, 'id', 'name');
        return $list;
    }

    public static function getProvinceNames() {
        $provinces = self::find()->orderBy(['name' => SORT_ASC])->all();
        $list = ArrayHelper::map($provinces, 'name', 'name');
        return $list;
    }

    public static function getProvinceById($id) {
        $province = self::find()->where(['id' => $id])->one();
        return $province->name;
    }

    public static function getName($id) {
        $province = self::find()->where(['id' => $id])->one();
        return ucfirst(strtolower($this->name));
    }

    public static function getCoordinates($coordinate_array) {
        $coordinates = [];
        foreach ($coordinate_array[0][0] as $coordinate) {
            array_push($coordinates, new LatLng(['lat' => $coordinate[1], 'lng' => $coordinate[0]]));
        }
        return $coordinates;
    }

}
