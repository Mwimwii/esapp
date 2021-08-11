<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_eligibility".
 *
 * @property int $id
 * @property int $application_id
 * @property int $organisation_id
 * @property string|null $criterion
 * @property string|null $satisfactory
 * @property string|null $approve_submittion
 * @property string|null $verified_by
 *
 * @property MgfApplication $application
 * @property MgfOrganisation $organisation
 */
class MgfEligibility extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_eligibility';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['application_id', 'organisation_id'], 'required'],
            [['application_id', 'organisation_id'], 'integer'],
            [['criterion'], 'string'],
            [['approve_submittion'], 'safe'],
            [['satisfactory'], 'string', 'max' => 4],
            [['verified_by'], 'string', 'max' => 20],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfApplication::className(), 'targetAttribute' => ['application_id' => 'id']],
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
            'application_id' => 'Application ID',
            'organisation_id' => 'Organisation ID',
            'criterion' => 'Criterion',
            'satisfactory' => 'Satisfactory',
            'approve_submittion' => 'Approve Submittion',
            'verified_by' => 'Verified By',
        ];
    }

    /**
     * Gets query for [[Application]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(MgfApplication::className(), ['id' => 'application_id']);
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
