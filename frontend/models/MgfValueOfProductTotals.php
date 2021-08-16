<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_value_of_product_totals".
 *
 * @property int $id
 * @property float|null $total_yr1_value
 * @property float|null $total_yr2_value
 * @property float|null $total_yr3_value
 * @property float|null $total_yr4_value
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 */
class MgfValueOfProductTotals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_value_of_product_totals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total_yr1_value', 'total_yr2_value', 'total_yr3_value', 'total_yr4_value'], 'number'],
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
            'total_yr1_value' => 'Total Yr1 Value',
            'total_yr2_value' => 'Total Yr2 Value',
            'total_yr3_value' => 'Total Yr3 Value',
            'total_yr4_value' => 'Total Yr4 Value',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
