<<<<<<< HEAD
<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_application".
 *
 * @property int $id
 * @property int|null $attachements
 * @property int $applicant_id
 * @property int $organisation_id
 * @property string $application_status
 * @property int $is_active
 * @property string $date_created
 * @property string|null $date_submitted
 *
 * @property MgfApplicant $applicant
 * @property MgfOrganisation $organisation
 * @property MgfApproval[] $mgfApprovals
 * @property MgfAttachements[] $mgfAttachements
 * @property MgfConceptNote[] $mgfConceptNotes
 */
class MgfApplication extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attachements', 'applicant_id', 'organisation_id', 'is_active'], 'integer'],
            [['applicant_id', 'organisation_id'], 'required'],
            [['date_created', 'date_submitted'], 'safe'],
            [['application_status'], 'string', 'max' => 15],
            [['applicant_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfApplicant::className(), 'targetAttribute' => ['applicant_id' => 'id']],
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
            'attachements' => 'Attachements',
            'applicant_id' => 'Applicant ID',
            'organisation_id' => 'Organisation ID',
            'application_status' => 'Application Status',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_submitted' => 'Date Submitted',
        ];
    }

    /**
     * Gets query for [[Applicant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplicant()
    {
        return $this->hasOne(MgfApplicant::className(), ['id' => 'applicant_id']);
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
     * Gets query for [[MgfApprovals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfApprovals()
    {
        return $this->hasMany(MgfApproval::className(), ['application_id' => 'id']);
    }

    /**
     * Gets query for [[MgfAttachements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfAttachements()
    {
        return $this->hasMany(MgfAttachements::className(), ['application_id' => 'id']);
    }

    /**
     * Gets query for [[MgfConceptNotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfConceptNotes()
    {
        return $this->hasMany(MgfConceptNote::className(), ['application_id' => 'id']);
    }
}
=======
<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_application".
 *
 * @property int $id
 * @property int|null $attachements
 * @property int $applicant_id
 * @property int $organisation_id
 * @property string $application_status
 * @property int $is_active
 * @property string $date_created
 * @property string|null $date_submitted
 *
 * @property MgfApplicant $applicant
 * @property MgfOrganisation $organisation
 * @property MgfApproval[] $mgfApprovals
 * @property MgfAttachements[] $mgfAttachements
 * @property MgfConceptNote[] $mgfConceptNotes
 */
class MgfApplication extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attachements', 'applicant_id', 'organisation_id', 'is_active'], 'integer'],
            [['applicant_id', 'organisation_id'], 'required'],
            [['date_created', 'date_submitted'], 'safe'],
            [['application_status'], 'string', 'max' => 15],
            [['applicant_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfApplicant::className(), 'targetAttribute' => ['applicant_id' => 'id']],
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
            'attachements' => 'Attachements',
            'applicant_id' => 'Applicant ID',
            'organisation_id' => 'Organisation ID',
            'application_status' => 'Application Status',
            'is_active' => 'Is Active',
            'date_created' => 'Date Created',
            'date_submitted' => 'Date Submitted',
        ];
    }

    /**
     * Gets query for [[Applicant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplicant()
    {
        return $this->hasOne(MgfApplicant::className(), ['id' => 'applicant_id']);
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
     * Gets query for [[MgfApprovals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfApprovals()
    {
        return $this->hasMany(MgfApproval::className(), ['application_id' => 'id']);
    }

    /**
     * Gets query for [[MgfAttachements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfAttachements()
    {
        return $this->hasMany(MgfAttachements::className(), ['application_id' => 'id']);
    }

    /**
     * Gets query for [[MgfConceptNotes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfConceptNotes()
    {
        return $this->hasMany(MgfConceptNote::className(), ['application_id' => 'id']);
    }
}
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
