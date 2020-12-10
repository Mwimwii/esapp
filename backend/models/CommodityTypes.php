<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "commodity_type".
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $name
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property CommodityPriceCollection[] $commodityPriceCollections
 * @property CommodityCategory $category
 */
class CommodityTypes extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'commodity_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            ['name', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name') &&
                            empty($model->category_id) ? TRUE : FALSE;
                }, 'message' => 'Commodity type already exist!'],
            ['name', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('name') && !empty(self::findOne(['name' => $model->name, "category_id" => $model->category_id])) ? TRUE : FALSE;
                }, 'message' => 'Commodity type already exist for this category!'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CommodityCategories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'name' => 'Name',
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
        return $this->hasMany(CommodityPriceCollection::className(), ['commodity_type_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(CommodityCategory::className(), ['id' => 'category_id']);
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

}
