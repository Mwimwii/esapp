<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "commodity_type".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property AwpbActivityLineItem[] $awpbActivityLineItems
 * @property CommodityPriceCollection[] $commodityPriceCollections
 * @property CommodityCategory $category
 */
class CommodityType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'commodity_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'created_at', 'updated_at'], 'required'],
            [['category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CommodityCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
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
        return $this->hasMany(AwpbActivityLineItem::className(), ['commodity_type_id' => 'id']);
    }

    /**
     * Gets query for [[CommodityPriceCollections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommodityPriceCollections()
    {
        return $this->hasMany(CommodityPriceCollection::className(), ['commodity_type_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CommodityCategory::className(), ['id' => 'category_id']);
    }
}
