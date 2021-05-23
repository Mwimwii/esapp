<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "awpb_template".
 *
 * @property int $id
 * @property int $fiscal_year
 * @property string $budget_theme
 * @property string $deadline_preparation_first_draft
 * @property string $deadline_submission_pco
 * @property string $deadline_consolidation
 * @property string $deadline_review_draft_paricipants
 * @property string $deadline_preparation_second_draft
 * @property string $deadline_review_pco
 * @property string $deadline_finalisation_pco
 * @property string $deadline_submission_ministry
 * @property string $deadline_approval_jpsc
 * @property string $deadline_incorporation_ministry
 * @property string $deadline_submission_ifad
 * @property string $deadline_comment_ifad
 * @property string $deadline_finalisation
 * @property string $comment
 * @property string $url_guideline
 * @property int $status 0 Closed, 1 open, 2 Blockedsed
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class AwpbTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fiscal_year', 'budget_theme', 'deadline_preparation_first_draft', 'deadline_submission_pco', 'deadline_consolidation', 'deadline_review_draft_paricipants', 'deadline_preparation_second_draft', 'deadline_review_pco', 'deadline_finalisation_pco', 'deadline_submission_ministry', 'deadline_approval_jpsc', 'deadline_incorporation_ministry', 'deadline_submission_ifad', 'deadline_comment_ifad', 'deadline_finalisation', 'comment', 'url_guideline', 'status', 'created_at', 'updated_at'], 'required'],
            [['fiscal_year', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['deadline_preparation_first_draft', 'deadline_submission_pco', 'deadline_consolidation', 'deadline_review_draft_paricipants', 'deadline_preparation_second_draft', 'deadline_review_pco', 'deadline_finalisation_pco', 'deadline_submission_ministry', 'deadline_approval_jpsc', 'deadline_incorporation_ministry', 'deadline_submission_ifad', 'deadline_comment_ifad', 'deadline_finalisation'], 'safe'],
            [['budget_theme'], 'string', 'max' => 512],
            [['comment'], 'string', 'max' => 1000],
            [['url_guideline'], 'string', 'max' => 255],
            [['fiscal_year'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fiscal_year' => 'Fiscal Year',
            'budget_theme' => 'Budget Theme',
            'deadline_preparation_first_draft' => 'Deadline Preparation First Draft',
            'deadline_submission_pco' => 'Deadline Submission Pco',
            'deadline_consolidation' => 'Deadline Consolidation',
            'deadline_review_draft_paricipants' => 'Deadline Review Draft Paricipants',
            'deadline_preparation_second_draft' => 'Deadline Preparation Second Draft',
            'deadline_review_pco' => 'Deadline Review Pco',
            'deadline_finalisation_pco' => 'Deadline Finalisation Pco',
            'deadline_submission_ministry' => 'Deadline Submission Ministry',
            'deadline_approval_jpsc' => 'Deadline Approval Jpsc',
            'deadline_incorporation_ministry' => 'Deadline Incorporation Ministry',
            'deadline_submission_ifad' => 'Deadline Submission Ifad',
            'deadline_comment_ifad' => 'Deadline Comment Ifad',
            'deadline_finalisation' => 'Deadline Finalisation',
            'comment' => 'Comment',
            'url_guideline' => 'Url Guideline',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
