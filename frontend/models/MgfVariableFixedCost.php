<?php

namespace frontend\models;
use backend\models\user;
use Yii;

/**
 * This is the model class for table "mgf_variable_fixed_cost".
 *
 * @property int $id
 * @property string $cost_name
 * @property string|null $cost_type
 * @property float|null $cost_yr1_value
 * @property float|null $cost_yr2_value
 * @property float|null $cost_yr3_value
 * @property float|null $cost_yr4_value
 * @property string|null $comment
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 */
class MgfVariableFixedCost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_variable_fixed_cost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cost_name', 'proposal_id', 'created_by'], 'required'],
            [['cost_yr1_value', 'cost_yr2_value', 'cost_yr3_value', 'cost_yr4_value'], 'number'],
            [['proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['date_created', 'date_update'], 'safe'],
            [['cost_name'], 'string', 'max' => 200],
            [['cost_type'], 'string', 'max' => 11],
            [['comment'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cost_name' => 'Cost Name',
            'cost_type' => 'Cost Type',
            'cost_yr1_value' => 'Cost Yr1 Value',
            'cost_yr2_value' => 'Cost Yr2 Value',
            'cost_yr3_value' => 'Cost Yr3 Value',
            'cost_yr4_value' => 'Cost Yr4 Value',
            'comment' => 'Comment',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
