<?php

namespace frontend\models;
use frontend\models\MgfProposal;
use backend\models\User;

use Yii;

/**
 * This is the model class for table "mgf_implementation_arrangements_cooperating_partners".
 *
 * @property int $id
 * @property string $main_activities
 * @property string|null $respobility
 * @property string|null $experience
 * @property string|null $comment
 * @property string $typee
 * @property int $proposal_id
 * @property string $date_created
 * @property int $created_by
 * @property int $created_at
 * @property int|null $updated_by
 *
 * @property Users $createdBy
 * @property MgfProposal $proposal
 */
class MgfImplementationArrangementsCooperatingPartners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_implementation_arrangements_cooperating_partners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_activities', 'typee', 'proposal_id', 'created_by', 'created_at'], 'required'],
            [['typee'], 'string'],
            [['proposal_id', 'created_by', 'created_at', 'updated_by'], 'integer'],
            [['date_created'], 'safe'],
            [['main_activities'], 'string', 'max' => 100],
            [['respobility'], 'string', 'max' => 20],
            [['experience', 'comment'], 'string', 'max' => 50],
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
            'main_activities' => 'Main Activities',
            'respobility' => 'Respobility',
            'experience' => 'Experience',
            'comment' => 'Comment',
            'typee' => 'Typee',
            'proposal_id' => 'Proposal ID',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
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
