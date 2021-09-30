<?php

<<<<<<< HEAD
namespace app\models;

use Yii;
=======

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d

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
<<<<<<< HEAD
 */
class AwpbTemplate extends \yii\db\ActiveRecord
{
=======
 *
 * @property AwpbActivity[] $awpbActivities
 * @property AwpbActivityLine[] $awpbActivityLines
 * @property AwpbTemplateActivity[] $awpbTemplateActivities
 */
class AwpbTemplate extends \yii\db\ActiveRecord
{
   
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_CURRENT_BUDGET = 2;
    const STATUS_OLD_BUDGET = 3;
    public $activities;
    public $users;

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
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
<<<<<<< HEAD
            [['fiscal_year', 'budget_theme', 'deadline_preparation_first_draft', 'deadline_submission_pco', 'deadline_consolidation', 'deadline_review_draft_paricipants', 'deadline_preparation_second_draft', 'deadline_review_pco', 'deadline_finalisation_pco', 'deadline_submission_ministry', 'deadline_approval_jpsc', 'deadline_incorporation_ministry', 'deadline_submission_ifad', 'deadline_comment_ifad', 'deadline_finalisation', 'comment', 'url_guideline', 'status', 'created_at', 'updated_at'], 'required'],
            [['fiscal_year', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['deadline_preparation_first_draft', 'deadline_submission_pco', 'deadline_consolidation', 'deadline_review_draft_paricipants', 'deadline_preparation_second_draft', 'deadline_review_pco', 'deadline_finalisation_pco', 'deadline_submission_ministry', 'deadline_approval_jpsc', 'deadline_incorporation_ministry', 'deadline_submission_ifad', 'deadline_comment_ifad', 'deadline_finalisation'], 'safe'],
            [['budget_theme'], 'string', 'max' => 512],
            [['comment'], 'string', 'max' => 1000],
            [['url_guideline'], 'string', 'max' => 255],
=======

            [['fiscal_year', 'budget_theme', 'comment', 'status', 'preparation_deadline_first_draft', 'submission_deadline', 'consolidation_deadline', 'review_deadline', 'preparation_deadline_second_draft', 'review_deadline_pco', 'finalisation_deadline_pco', 'submission_deadline_moa_mfl', 'approval_deadline_jpsc', 'incorpation_deadline_pco_moa_mfl', 'submission_deadline_ifad','comment_deadline_ifad','distribution_deadline'], 'required'],
            [['fiscal_year', 'status', 'status_activities', 'status_users', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['budget_theme', 'comment'], 'string'],
            [['preparation_deadline_first_draft', 'submission_deadline', 'consolidation_deadline', 'review_deadline', 'preparation_deadline_second_draft', 'review_deadline_pco', 'finalisation_deadline_pco', 'submission_deadline_moa_mfl', 'approval_deadline_jpsc', 'incorpation_deadline_pco_moa_mfl', 'submission_deadline_ifad','comment_deadline_ifad','distribution_deadline'], 'safe'],
            [['guideline_file'], 'string', 'max' => 255],

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
            [['fiscal_year'], 'unique'],
        ];
    }

<<<<<<< HEAD
=======
	public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fiscal_year' => 'Fiscal Year',
            'budget_theme' => 'Budget Theme',
<<<<<<< HEAD
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
=======

            'comment' => 'Comment',
            'guideline_file' => 'Guideline File',
            'status' => 'Status',
            'status_activities' => 'Status Activities',
            'status_users' => 'Status Users',
            'preparation_deadline_first_draft' => 'Deadline for preparing the AWPB by participating institution',
            'submission_deadline' => 'Deadline for submitting the AWPB proposals to PCO',
            'consolidation_deadline' => 'Deadline for consolidating AWPB',
            'review_deadline' => 'Deadline for reviewing the draft AWPB by participating institution',
            'preparation_deadline_second_draft' => 'Deadline for preparing the second AWPB Draft by participating institution',
            'review_deadline_pco' => 'Deadline for review the AWPB by PCO',
            'finalisation_deadline_pco' => 'Deadline for AWPB finalisation by PCO',
            'submission_deadline_moa_mfl' => 'Deadline for submitting AWPB to MoA/MFL',
            'approval_deadline_jpsc' => 'Deadline for approving AWPB by JPSC',
            'incorpation_deadline_pco_moa_mfl' => 'Deadline for incorpating PCO Budget into MoA/MFL budget',
            'submission_deadline_ifad' => 'Deadline for submitting AWPB to IFAD',
            'comment_deadline_ifad'=>'Deadline for receiving AWPB comments from IFAD',
            'distribution_deadline'=>'Deadline for distributing the AWPB to institutions',

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
<<<<<<< HEAD
=======


    /**
     * Gets query for [[AwpbActivities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivities()
    {
        return $this->hasMany(AwpbActivity::className(), ['awpb_template_id' => 'id']);
    }

    /**
     * Gets query for [[AwpbActivityLines]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbActivityLines()
    {
        return $this->hasMany(AwpbActivityLine::className(), ['awpb_template_id' => 'id']);
    }

    /**
     * Gets query for [[AwpbTemplateActivities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbTemplateActivities()
    {
        return $this->hasMany(AwpbTemplateActivity::className(), ['awpb_template_id' => 'id']);
    }
    public function getAwpbTemplateUsers()
    {
        return $this->hasMany(AwpbTemplateUsers::className(), ['awpb_template_id' => 'id']);
    }
    public static function getId() {
        //$template = self::find()->where(['<>','status',AwpbTemplate::STATUS_OLD_BUDGET])->one();
        $template = self::find()->where(['status'=>self::STATUS_PUBLISHED])->one();
             
        return  $template->id;
    }
    public static function getAwpbTemplates() {
        $data = self::find()->orderBy(['fiscal_year' => SORT_ASC])
        ->where(['status'=>self::STATUS_PUBLISHED])
        ->one();
        $list = ArrayHelper::map($data, 'id', 'fiscal_year');
        return $list;
    }

>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
}
