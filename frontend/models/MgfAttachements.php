<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_attachements".
 *
 * @property int $id
 * @property string $registration_certificate
 * @property string $articles_of_assoc
 * @property string $audit_reports
 * @property string $mou_contract
 * @property string $board_resolution
 * @property string $application_attachement
 * @property int $organisation_id
 * @property int $application_id
 * @property string $date_created
 *
 * @property MgfOrganisation $organisation
 * @property MgfApplication $application
 */
class MgfAttachements extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_attachements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['registration_certificate', 'articles_of_assoc', 'audit_reports', 'mou_contract', 'board_resolution', 'application_attachement', 'organisation_id', 'application_id'], 'required'],
            [['registration_certificate', 'articles_of_assoc', 'audit_reports', 'mou_contract', 'board_resolution', 'application_attachement'], 'string'],
            [['organisation_id', 'application_id'], 'integer'],
            [['date_created'], 'safe'],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfOrganisation::className(), 'targetAttribute' => ['organisation_id' => 'id']],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfApplication::className(), 'targetAttribute' => ['application_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'registration_certificate' => 'Certificate of Incorporation/ or any other legal Business Registration Certificate',
            'articles_of_assoc' => 'Articles of Association / Constituion',
            'audit_reports' => 'Audit Reports',
            'mou_contract' => 'Any Contract/MOU for collaboration with smallholder farmers/producer Groups, Agro-rural MSME',
            'board_resolution' => 'Executive / Board Resolution permitting seeking of assistance from E-SAPP',
            'application_attachement' => 'Application Attachement',
            'organisation_id' => 'Organisation',
            'application_id' => 'Application',
            'date_created' => 'Date Created',
        ];
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

    /**
     * Gets query for [[Application]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(MgfApplication::className(), ['id' => 'application_id']);
    }
}
