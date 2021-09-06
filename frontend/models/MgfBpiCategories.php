<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_bpi_categories".
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $category_description
 */
class MgfBpiCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_bpi_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['category_description'], 'string', 'max' => 100],
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
            'category_description' => 'Category Description',
        ];
    }
}
