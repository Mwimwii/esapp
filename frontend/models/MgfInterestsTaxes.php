<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_interests_taxes".
 *
 * @property int $id
 * @property string|null $interest_tax_type
 * @property float|null $interest_tax_percent
 * @property string|null $interest_tax_name
 * @property float|null $interest_yr1_value
 * @property float|null $interest_yr2_value
 * @property float|null $interest_yr3_value
 * @property float|null $interest_yr4_value
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 */
class MgfInterestsTaxes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_interests_taxes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['interest_tax_type'], 'string'],
            [['interest_tax_percent', 'interest_yr1_value', 'interest_yr2_value', 'interest_yr3_value', 'interest_yr4_value'], 'number'],
            [['proposal_id', 'created_by'], 'required'],
            [['proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['date_created', 'date_update'], 'safe'],
            [['interest_tax_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'interest_tax_type' => 'Interest/Tax Type',
<<<<<<< HEAD
            'interest_tax_percent' => 'Interest/Tax Percent(%)',
=======
            'interest_tax_percent' => 'Interest/Tax Percent',
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
            'interest_tax_name' => 'Interest/Tax Name',
            'interest_yr1_value' => 'Interest Yr1 Value',
            'interest_yr2_value' => 'Interest Yr2 Value',
            'interest_yr3_value' => 'Interest Yr3 Value',
            'interest_yr4_value' => 'Interest Yr4 Value',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
