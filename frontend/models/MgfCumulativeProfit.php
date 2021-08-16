<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_cumulative_profit".
 *
 * @property int $id
 * @property float|null $cumulative_profit_yr1_value
 * @property float|null $cumulative_profit_yr2_value
 * @property float|null $cumulative_profit_yr3_value
 * @property float|null $cumulative_profit_yr4_value
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 */
class MgfCumulativeProfit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_cumulative_profit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cumulative_profit_yr1_value', 'cumulative_profit_yr2_value', 'cumulative_profit_yr3_value', 'cumulative_profit_yr4_value'], 'number'],
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
            'cumulative_profit_yr1_value' => 'Cumulative Profit Yr1 Value',
            'cumulative_profit_yr2_value' => 'Cumulative Profit Yr2 Value',
            'cumulative_profit_yr3_value' => 'Cumulative Profit Yr3 Value',
            'cumulative_profit_yr4_value' => 'Cumulative Profit Yr4 Value',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
