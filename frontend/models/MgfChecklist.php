<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_checklist".
 *
 * @property int $id
 * @property int $applicant_id
 * @property int $application_id
 * @property int $proposal_id
 * @property int $organisation_created
 * @property int $contacts_added
 * @property int $management_updated
 * @property int $experience_updated
 * @property int $attachements_uploaded
 * @property int $profile_confirmed
 * @property int $concept_created
 * @property int $concept_submitted
 * @property int $proposal_created
 * @property int $components_created
 * @property int $activities_created
 * @property int $items_created
 * @property int $project_submitted
 * @property string $date_created
 */
class MgfChecklist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_checklist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['applicant_id'], 'required'],
            [['applicant_id', 'application_id', 'proposal_id', 'organisation_created', 'contacts_added', 'management_updated', 'experience_updated', 'attachements_uploaded', 'profile_confirmed', 'concept_created', 'concept_submitted', 'proposal_created', 'components_created', 'activities_created', 'items_created', 'project_submitted'], 'integer'],
            [['date_created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'applicant_id' => 'Applicant ID',
            'application_id' => 'Application ID',
            'proposal_id' => 'Proposal ID',
            'organisation_created' => 'Organisation Created',
            'contacts_added' => 'Contacts Added',
            'management_updated' => 'Management Updated',
            'experience_updated' => 'Experience Updated',
            'attachements_uploaded' => 'Attachements Uploaded',
            'profile_confirmed' => 'Profile Confirmed',
            'concept_created' => 'Concept Created',
            'concept_submitted' => 'Concept Submitted',
            'proposal_created' => 'Proposal Created',
            'components_created' => 'Components Created',
            'activities_created' => 'Activities Created',
            'items_created' => 'Items Created',
            'project_submitted' => 'Project Submitted',
            'date_created' => 'Date Created',
        ];
    }
}
