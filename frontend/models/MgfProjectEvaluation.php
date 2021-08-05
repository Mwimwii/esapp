<?php

namespace frontend\models;
use backend\models\User;

use Yii;

/**
 * This is the model class for table "mgf_project_evaluation".
 *
 * @property int $id
 * @property int $proposal_id
 * @property int $organisation_id
 * @property string|null $window
 * @property int $status
 * @property string|null $observation
 * @property string|null $declaration
 * @property string|null $totalscore
 * @property string|null $decision
 * @property string $date_created
 * @property string|null $date_submitted
 * @property string|null $date_reviewed
 * @property int $reviewedby
 * @property string|null $signature
 *
 * @property Users $reviewedby0
 * @property MgfProposal $proposal
 * @property MgfOrganisation $organisation
 */
class MgfProjectEvaluation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_project_evaluation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proposal_id', 'organisation_id', 'reviewedby'], 'required'],
            [['proposal_id', 'organisation_id', 'status', 'reviewedby'], 'integer'],
            [['window', 'observation', 'declaration', 'signature'], 'string'],
            [['date_created', 'date_submitted', 'date_reviewed'], 'safe'],
            [['totalscore'], 'string', 'max' => 5],
            [['decision'], 'string', 'max' => 20],
            [['reviewedby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['reviewedby' => 'id']],
            [['proposal_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfProposal::className(), 'targetAttribute' => ['proposal_id' => 'id']],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfOrganisation::className(), 'targetAttribute' => ['organisation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'proposal_id' => 'Proposal',
            'organisation_id' => 'Organisation ID',
            'window' => 'Window',
            'status' => 'Status',
            'observation' => 'Observation',
            'declaration' => 'Declaration',
            'totalscore' => 'Totalscore (%)',
            'decision' => 'Decision',
            'date_created' => 'Date Created',
            'date_submitted' => 'Date Submitted',
            'date_reviewed' => 'Date Reviewed',
            'reviewedby' => 'Reviewedby',
            'signature' => 'Signature',
        ];
    }

    /**
     * Gets query for [[Reviewedby0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewedby0(){
        return $this->hasOne(User::className(), ['id' => 'reviewedby']);
    }

    /**
     * Gets query for [[Proposal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProposal(){
        return $this->hasOne(MgfProposal::className(), ['id' => 'proposal_id']);
    }

    /**
     * Gets query for [[Organisation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation(){
        return $this->hasOne(MgfOrganisation::className(), ['id' => 'organisation_id']);
    }
}
