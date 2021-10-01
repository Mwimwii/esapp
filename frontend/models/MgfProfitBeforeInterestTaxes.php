<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_profit_before_interest_taxes".
 *
 * @property int $id
 * @property float|null $profit_yr1_value
 * @property float|null $profit_yr2_value
 * @property float|null $profit_yr3_value
 * @property float|null $profit_yr4_value
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 */
class MgfProfitBeforeInterestTaxes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_profit_before_interest_taxes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['profit_yr1_value', 'profit_yr2_value', 'profit_yr3_value', 'profit_yr4_value'], 'number'],
            [['proposal_id', 'created_by'], 'required'],
            [['proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['date_created', 'date_update'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'profit_yr1_value' => 'Profit Yr1 Value',
            'profit_yr2_value' => 'Profit Yr2 Value',
            'profit_yr3_value' => 'Profit Yr3 Value',
            'profit_yr4_value' => 'Profit Yr4 Value',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
