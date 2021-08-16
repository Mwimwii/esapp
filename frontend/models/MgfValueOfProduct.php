<?php

namespace frontend\models;
use backend\models\user;

use Yii;

/**
 * This is the model class for table "mgf_value_of_product".
 *
 * @property int $id
 * @property string $product_name
 * @property string|null $product_unit
 * @property int|null $product_yr1_qty
 * @property float|null $product_yr1_price
 * @property float|null $product_yr1_value
 * @property int|null $product_yr2_qty
 * @property float|null $product_yr2_price
 * @property float|null $product_yr2_value
 * @property int|null $product_yr3_qty
 * @property float|null $product_yr3_price
 * @property float|null $product_yr3_value
 * @property int|null $product_yr4_qty
 * @property float|null $product_yr4_price
 * @property float|null $product_yr4_value
 * @property string|null $comment
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 *
 * @property User $createdBy
 * @property MgfProposal $proposal
 */
class MgfValueOfProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_value_of_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name', 'proposal_id', 'created_by'], 'required'],
            [['product_yr1_qty', 'product_yr2_qty', 'product_yr3_qty', 'product_yr4_qty', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['product_yr1_price', 'product_yr1_value', 'product_yr2_price', 'product_yr2_value', 'product_yr3_price', 'product_yr3_value', 'product_yr4_price', 'product_yr4_value'], 'number'],
            [['date_created', 'date_update'], 'safe'],
            [['product_name'], 'string', 'max' => 200],
            [['product_unit'], 'string', 'max' => 11],
            [['comment'], 'string', 'max' => 100],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['proposal_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfProposal::className(), 'targetAttribute' => ['proposal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'product_unit' => 'Product Unit',
            'product_yr1_qty' => 'Product Yr1 Qty',
            'product_yr1_price' => 'Product Yr1 Price',
            'product_yr1_value' => 'Product Yr1 Value',
            'product_yr2_qty' => 'Product Yr2 Qty',
            'product_yr2_price' => 'Product Yr2 Price',
            'product_yr2_value' => 'Product Yr2 Value',
            'product_yr3_qty' => 'Product Yr3 Qty',
            'product_yr3_price' => 'Product Yr3 Price',
            'product_yr3_value' => 'Product Yr3 Value',
            'product_yr4_qty' => 'Product Yr4 Qty',
            'product_yr4_price' => 'Product Yr4 Price',
            'product_yr4_value' => 'Product Yr4 Value',
            'comment' => 'Comment',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Proposal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProposal()
    {
        return $this->hasOne(MgfProposal::className(), ['id' => 'proposal_id']);
    }
}
