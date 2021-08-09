<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property int $id
 * @property int $province_id
 * @property string $name
 * @property string|null $lat
 * @property string|null $long
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivityLineItem[] $awpbActivityLineItems
 * @property Camp[] $camps
 * @property CommodityPriceCollection[] $commodityPriceCollections
 * @property Province $province
 * @property Market[] $markets
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_id', 'name', 'created_at', 'updated_at'], 'required'],
            [['province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['lat', 'long'], 'string', 'max' => 20],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::className(), 'targetAttribute' => ['province_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'province_id' => 'Province ID',
            'name' => 'Name',
            'lat' => 'Lat',
            'long' => 'Long',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[AwpbActivityLineItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivityLineItems()
    {
        return $this->hasMany(AwpbActivityLineItem::className(), ['district_id' => 'id']);
    }

    /**
     * Gets query for [[Camps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCamps()
    {
        return $this->hasMany(Camp::className(), ['district_id' => 'id']);
    }

    /**
     * Gets query for [[CommodityPriceCollections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommodityPriceCollections()
    {
        return $this->hasMany(CommodityPriceCollection::className(), ['district' => 'id']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::className(), ['id' => 'province_id']);
    }

    /**
     * Gets query for [[Markets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarkets()
    {
        return $this->hasMany(Market::className(), ['district_id' => 'id']);
    }
}
