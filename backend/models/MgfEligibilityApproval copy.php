<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_eligibility_approval".
 *
 * @property int $id
 * @property int $application_id
 * @property int|null $is_active
 * @property string|null $scores
 * @property string|null $review_remark
 * @property string|null $review_submission
 * @property string|null $reviewed_by
 * @property string|null $certify_remark
 * @property string|null $certify_submission
 * @property string|null $certified_by
 * @property string|null $review2_remark
 * @property string|null $review2_submission
 * @property string|null $reviewed2_by
 * @property string|null $approval_remark
 * @property string|null $approve_submittion
 * @property string|null $approved_by
 *
 * @property MgfApplication $application
 */
class MgfEligibilityApproval extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_eligibility_approval';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['application_id'], 'required'],
            [['application_id', 'is_active'], 'integer'],
            [['review_remark', 'certify_remark', 'review2_remark', 'approval_remark'], 'string'],
            [['review_submission', 'certify_submission', 'review2_submission', 'approve_submittion'], 'safe'],
            [['scores'], 'string', 'max' => 5],
            [['reviewed_by', 'certified_by', 'reviewed2_by', 'approved_by'], 'string', 'max' => 20],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfApplication::className(), 'targetAttribute' => ['application_id' => 'id']],
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
            'is_active' => 'Is Active',
            'scores' => 'Scores',
            'review_remark' => 'Review Remark',
            'review_submission' => 'Review Submission',
            'reviewed_by' => 'Reviewed By',
            'certify_remark' => 'Certify Remark',
            'certify_submission' => 'Certify Submission',
            'certified_by' => 'Certified By',
            'review2_remark' => 'Review2 Remark',
            'review2_submission' => 'Review2 Submission',
            'reviewed2_by' => 'Reviewed2 By',
            'approval_remark' => 'Approval Remark',
            'approve_submittion' => 'Approve Submittion',
            'approved_by' => 'Approved By',
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
}
