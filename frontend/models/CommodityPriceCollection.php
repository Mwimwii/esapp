<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "commodity_price_collection".
 *
 * @property int $id
 * @property int $district
 * @property int $market_id
 * @property int $commodity_type_id
 * @property int $price_level_id
 * @property string $unit_of_measure
 * @property float $price
 * @property string|null $description
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property District $district0
 * @property CommodityPriceLevel $priceLevel
 * @property Market $market
 * @property CommodityType $commodityType
 */
class CommodityPriceCollection extends \yii\db\ActiveRecord {

    public $province_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'commodity_price_collection';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['district', 'market_id', 'commodity_type_id', 'price_level_id', 'price', 'year', 'month'], 'required'],
            [['district', 'province_id', 'market_id', 'commodity_type_id', 'price_level_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['price'], 'number'],
            [['year', 'month', 'description'], 'safe'],
            ['commodity_type_id', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('commodity_type_id') &&
                            !empty(self::findOne(['commodity_type_id' => $model->commodity_type_id,
                                        "market_id" => $model->market_id,
                                        'year' => $model->year,
                                        "month" => $model->month,
                                        "price_level_id" => $model->price_level_id,
                                        "unit_of_measure" => $model->unit_of_measure])) ? TRUE : FALSE;
                }, 'message' => 'Commodity type exist for selected price level,market,unit of measure, year and month'],
            [['description'], 'string'],
            [['unit_of_measure'], 'string', 'max' => 45],
            [['district'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district' => 'id']],
            [['price_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => CommodityPriceLevels::className(), 'targetAttribute' => ['price_level_id' => 'id']],
            [['market_id'], 'exist', 'skipOnError' => true, 'targetClass' => Markets::className(), 'targetAttribute' => ['market_id' => 'id']],
            [['commodity_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CommodityTypes::className(), 'targetAttribute' => ['commodity_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'district' => 'District',
            'market_id' => 'Market',
            'commodity_type_id' => 'Commodity type',
            'price_level_id' => 'Price level',
            'unit_of_measure' => 'Unit',
            'price' => 'Price(ZMW)',
            'year' => 'Year',
            'month' => 'month',
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
     * Gets query for [[District0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict0() {
        return $this->hasOne(Districts::className(), ['id' => 'district']);
    }

    /**
     * Gets query for [[PriceLevel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriceLevel() {
        return $this->hasOne(CommodityPriceLevels::className(), ['id' => 'price_level_id']);
    }

    /**
     * Gets query for [[Market]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarket() {
        return $this->hasOne(Markets::className(), ['id' => 'market_id']);
    }

    /**
     * Gets query for [[CommodityType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommodityType() {
        return $this->hasOne(CommodityTypes::className(), ['id' => 'commodity_type_id']);
    }

    public static function getYearsList() {
        $currentYear = date('Y');
        $yearFrom = 2000;
        $yearsRange = range($yearFrom, $currentYear);
        return array_combine($yearsRange, $yearsRange);
    }

}
