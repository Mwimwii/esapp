<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_approval".
 *
 * @property int $id
 * @property int $application_id
 * @property int $conceptnote_id
 * @property string|null $scores
 * @property string|null $review_remark
 * @property string|null $review_submission
 * @property string|null $reviewed_by
 * @property string|null $certify_remark
 * @property string|null $certify_submission
 * @property string|null $certified_by
 * @property string|null $district_minutes
 * @property string|null $province_minutes
 * @property string|null $pco_minutes
 * @property string|null $approval_remark
 * @property string|null $approve_submittion
 * @property string|null $approved_by
 *
 * @property MgfConceptNote $conceptnote
 * @property MgfApplication $application
 */
class MgfApproval extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_approval';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['application_id', 'conceptnote_id'], 'required'],
            [['application_id', 'conceptnote_id'], 'integer'],
            [['review_remark', 'certify_remark', 'district_minutes', 'province_minutes', 'pco_minutes', 'approval_remark'], 'string'],
            [['review_submission', 'certify_submission', 'approve_submittion'], 'safe'],
            [['scores'], 'string', 'max' => 5],
            [['reviewed_by', 'certified_by', 'approved_by'], 'string', 'max' => 20],
            [['conceptnote_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfConceptNote::className(), 'targetAttribute' => ['conceptnote_id' => 'id']],
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
            'conceptnote_id' => 'Conceptnote ID',
            'scores' => 'Scores',
            'review_remark' => 'District Remark',
            'review_submission' => 'Review Submission',
            'reviewed_by' => 'Reviewed By',
            'certify_remark' => 'Province Remark',
            'certify_submission' => 'Certify Submission',
            'certified_by' => 'Certified By',
            'district_minutes' => 'District Minutes',
            'province_minutes' => 'Province Minutes',
            'pco_minutes' => 'Pco Minutes',
            'approval_remark' => 'PCO Remark',
            'approve_submittion' => 'Approve Submittion',
            'approved_by' => 'Approved By',
        ];
    }

    /**
     * Gets query for [[Conceptnote]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConceptnote()
    {
        return $this->hasOne(MgfConceptNote::className(), ['id' => 'conceptnote_id']);
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
