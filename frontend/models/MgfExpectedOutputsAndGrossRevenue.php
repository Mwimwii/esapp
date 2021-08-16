<?php

namespace frontend\models;
use backend\models\user;

use Yii;

/**
 * This is the model class for table "mgf_expected_outputs_and_gross_revenue".
 *
 * @property int $id
 * @property string $output_name
 * @property string|null $unit_of_measure
 * @property int|null $quantity
 * @property float|null $expected_price
 * @property float|null $expected_gross_revenue
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
class MgfExpectedOutputsAndGrossRevenue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_expected_outputs_and_gross_revenue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['output_name', 'proposal_id', 'created_by'], 'required'],
            [['quantity', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['expected_price', 'expected_gross_revenue'], 'number'],
            [['date_created', 'date_update'], 'safe'],
            [['output_name', 'comment'], 'string', 'max' => 100],
            [['unit_of_measure'], 'string', 'max' => 20],
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
            'output_name' => 'Output Name',
            'unit_of_measure' => 'Unit Of Measure',
            'quantity' => 'Quantity',
            'expected_price' => 'Expected Price',
            'expected_gross_revenue' => 'Expected Gross Revenue',
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
