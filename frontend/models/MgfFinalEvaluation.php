<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_final_evaluation".
 *
 * @property int $id
 * @property int $proposal_id
 * @property int $organisation_id
 * @property int $status
 * @property string|null $finalscore
 * @property string|null $decision
 * @property int $notified
 * @property string|null $finalcomment
 * @property string|null $response
 * @property string $date_created
 *
 * @property MgfProposal $proposal
 * @property MgfOrganisation $organisation
 */
class MgfFinalEvaluation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_final_evaluation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proposal_id', 'organisation_id'], 'required'],
            [['proposal_id', 'organisation_id', 'status', 'notified'], 'integer'],
            [['finalcomment', 'response'], 'string'],
            [['date_created'], 'safe'],
            [['finalscore'], 'string', 'max' => 5],
            [['decision'], 'string', 'max' => 20],
            [['proposal_id'], 'unique'],
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
            'proposal_id' => 'Proposal ID',
            'organisation_id' => 'Organisation ID',
            'status' => 'Status',
            'finalscore' => 'Finalscore',
            'decision' => 'Decision',
            'notified' => 'Notified',
            'finalcomment' => 'Reason(s)',
            'response' => 'Response',
            'date_created' => 'Date Created',
        ];
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

    /**
     * Gets query for [[Organisation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(MgfOrganisation::className(), ['id' => 'organisation_id']);
    }
}
