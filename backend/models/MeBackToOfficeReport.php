<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "me_back_to_office_report".
 *
 * @property int $id
 * @property string $start_date
 * @property string $end_date
 * @property string $name_of_officer
 * @property string|null $team_members
 * @property string|null $key_partners Key partners in each location/site visited
 * @property string $purpose_of_assignment
 * @property string $summary_of_assignment_outcomes
 * @property string $key_findings
 * @property string $key_recommendations Key Recommendations/Actions to be taken, by whom
 * @property string $copy_sent_to
 * @property string|null $annexes
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class MeBackToOfficeReport extends \yii\db\ActiveRecord {

    public $travel_dates;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'me_back_to_office_report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [
                ['travel_dates', 'start_date', 'end_date', 'name_of_officer', 'purpose_of_assignment',
                    'summary_of_assignment_outcomes', 'key_findings', 'key_recommendations', 'status'
                ], 'required'
            ],
            [['start_date', 'end_date', 'travel_dates', 'team_members'], 'safe'],
            [['key_partners', 'purpose_of_assignment', 'summary_of_assignment_outcomes', 'key_findings', 'key_recommendations', 'copy_sent_to', 'annexes','reviewer_comments'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['name_of_officer'], 'string', 'max' => 45],
                //['start_date', 'shouldBeFuture'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'name_of_officer' => 'Name of officer',
            'team_members' => 'Team members',
            'key_partners' => 'Key partners',
            'purpose_of_assignment' => 'Purpose of assignment',
            'summary_of_assignment_outcomes' => 'Summary of assignment outcomes',
            'key_findings' => 'Key findings',
            'key_recommendations' => 'Key recommendations',
            'copy_sent_to' => 'Copy sent to',
            'annexes' => 'Annexes',
            'status' => 'Status',
            'reviewer_comments' => 'Reviewers comments',
            'travel_dates' => 'Travel dates',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /* public function shouldBeFuture($attribute, $params) {
      if ($this->start_date < date("Y-m-d")) {
      $this->addError('_leave_period', 'Travel start date sho future/todays date!');
      }
      } */
}
