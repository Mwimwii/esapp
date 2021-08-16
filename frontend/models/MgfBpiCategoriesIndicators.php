<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_bpi_categories_indicators".
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $indicator_id
 * @property string|null $indicator_description
 */
class MgfBpiCategoriesIndicators extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_bpi_categories_indicators';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'indicator_id'], 'integer'],
            [['indicator_description'], 'string', 'max' => 100],
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
            'indicator_id' => 'Indicator ID',
            'indicator_description' => 'Indicator Description',
        ];
    }
}
