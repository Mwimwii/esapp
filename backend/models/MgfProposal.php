<?php

namespace backend\models;
use backend\models\Districts;
use backend\models\Provinces;

use Yii;

/**
 * This is the model class for table "mgf_proposal".
 *
 * @property int $id
 * @property string|null $project_title
 * @property string $mgf_no
 * @property int $organisation_id
 * @property string|null $applicant_type
 * @property string $starting_date
 * @property string $ending_date
 * @property int $project_length
 * @property int number_reviewers
 * @property string|null $project_operations
 * @property string|null $any_experience
 * @property string|null $experience_response
 * @property string|null $indicate_partnerships
 * @property string $proposal_status
 * @property string $date_created
 * @property string|null $date_submitted
 * @property string|null $problem_statement
 * @property string|null $overall_objective
 * @property int|null $is_active
 * @property float|null $totalcost
 * @property int|null $province_id
 * @property int|null $district_id
 *
 * @property MgfComponent[] $mgfComponents
 * @property MgfFinalEvaluation $mgfFinalEvaluation
 * @property MgfOffer[] $mgfOffers
 * @property MgfProjectEvaluation[] $mgfProjectEvaluations
 * @property District $district
 * @property Province $province
 * @property MgfOrganisation $organisation
 * @property MgfProposalEvaluation[] $mgfProposalEvaluations
 */
class MgfProposal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_proposal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['mgf_no', 'organisation_id', 'starting_date'], 'required'],
            [['organisation_id', 'project_length', 'is_active', 'province_id', 'district_id','number_reviewers'], 'integer'],
            [['applicant_type', 'project_operations', 'any_experience', 'experience_response', 'indicate_partnerships', 'problem_statement', 'overall_objective'], 'string'],
            [['starting_date', 'date_created', 'date_submitted','number_reviewers'], 'safe'],
            [['totalcost'], 'number'],
            [['project_title','ending_date'], 'string', 'max' => 30],
            [['mgf_no'], 'string', 'max' => 11],
            [['proposal_status'], 'string', 'max' => 20],
            [['district_id'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['district_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provinces::className(), 'targetAttribute' => ['province_id' => 'id']],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfOrganisation::className(), 'targetAttribute' => ['organisation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'project_title' => 'Project Title',
            'mgf_no' => 'Mgf No',
            'organisation_id' => 'Organisation ID',
            'applicant_type' => 'Applicant Type',
            'starting_date' => 'Starting Date',
            'ending_date'=>'Ending Date',
            'project_length' => 'Implementation Period (Years)',
            'project_operations' => 'Type of Operations',
            'any_experience' => 'Have you had any past experience on the type of activities included in the proposed project?',
            'experience_response' => 'Elaborate on Experience',
            'indicate_partnerships' => 'Indicate Partnerships',
            'proposal_status' => 'Proposal Status',
            'number_reviewers'=>'Reviewers',
            'date_created' => 'Date Created',
            'date_submitted' => 'Date Submitted',
            'problem_statement' => 'Problem Statement',
            'overall_objective' => 'Overall Objective',
            'is_active' => 'Is Active',
            'totalcost' => 'Total Estimated Cost (ZMW)',
            'province_id' => 'Province',
            'district_id' => 'District',
        ];
    }

    /**
     * Gets query for [[MgfComponents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfComponents()
    {
        return $this->hasMany(MgfComponent::className(), ['proposal_id' => 'id']);
    }

    /**
     * Gets query for [[MgfFinalEvaluation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfFinalEvaluation()
    {
        return $this->hasOne(MgfFinalEvaluation::className(), ['proposal_id' => 'id']);
    }

    /**
     * Gets query for [[MgfOffers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfOffers()
    {
        return $this->hasMany(MgfOffer::className(), ['proposal_id' => 'id']);
    }

    /**
     * Gets query for [[MgfProjectEvaluations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfProjectEvaluations()
    {
        return $this->hasMany(MgfProjectEvaluation::className(), ['proposal_id' => 'id']);
    }

    /**
     * Gets query for [[District]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['id' => 'district_id']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Provinces::className(), ['id' => 'province_id']);
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
     * Gets query for [[MgfProposalEvaluations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfProposalEvaluations()
    {
        return $this->hasMany(MgfProposalEvaluation::className(), ['proposal_id' => 'id']);
    }
}
