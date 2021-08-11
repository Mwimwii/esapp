<?php

namespace frontend\models;
use backend\models\user;
use frontend\models\MgfProposal;

use Yii;

/**
 * This is the model class for table "mgf_existing_facilities".
 *
 * @property int $id
 * @property string $facility_name
 * @property string|null $description
 * @property int|null $quantity
 * @property string|null $use_to_be_made
 * @property float|null $estimate_cost
 * @property string|null $comment
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 *
 * @property Users $createdBy
 * @property MgfProposal $proposal
 */
class MgfExistingFacilities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_existing_facilities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['facility_name', 'proposal_id', 'created_by'], 'required'],
            [['quantity', 'proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['estimate_cost'], 'number'],
            [['date_created', 'date_update'], 'safe'],
            [['facility_name', 'description', 'use_to_be_made', 'comment'], 'string', 'max' => 100],
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
            'facility_name' => 'Facility Name',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'use_to_be_made' => 'Use To Be Made',
            'estimate_cost' => 'Estimate Cost',
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
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
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
