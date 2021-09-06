<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_netprofit".
 *
 * @property int $id
 * @property float|null $netprofit_yr1_value
 * @property float|null $netprofit_yr2_value
 * @property float|null $netprofit_yr3_value
 * @property float|null $netprofit_yr4_value
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 */
class MgfNetprofit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_netprofit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['netprofit_yr1_value', 'netprofit_yr2_value', 'netprofit_yr3_value', 'netprofit_yr4_value'], 'number'],
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
            'netprofit_yr1_value' => 'Netprofit Yr1 Value',
            'netprofit_yr2_value' => 'Netprofit Yr2 Value',
            'netprofit_yr3_value' => 'Netprofit Yr3 Value',
            'netprofit_yr4_value' => 'Netprofit Yr4 Value',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
