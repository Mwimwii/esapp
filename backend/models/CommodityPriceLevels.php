<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "commodity_price_level".
 *
 * @property int $id
 * @property string $level
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property CommodityPriceCollection[] $commodityPriceCollections
 */
class CommodityPriceLevels extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'commodity_price_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['level'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['level'], 'string', 'max' => 45],
            ['level', 'unique', 'message' => 'Price level exist already!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'level' => 'Level',
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
        return $this->hasMany(CommodityPriceCollection::className(), ['price_level_id' => 'id']);
    }

    public static function getLevels() {
        $levels = self::find()->orderBy(['level' => SORT_ASC])->all();
        return ArrayHelper::map($levels, 'level', 'level');
    }

    public static function getList() {
        $list = self::find()->orderBy(['level' => SORT_ASC])->all();
        return ArrayHelper::map($list, 'id', 'level');
    }

    public static function getById($id) {
        $data = self::find()->where(['id' => $id])->one();
        return $data->level;
    }

}
