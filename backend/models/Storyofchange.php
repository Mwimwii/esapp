<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "lkm_storyofchange".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title Title of the story of change
 * @property string|null $interviewee_names
 * @property string|null $interviewer_names
 * @property string|null $date_interviewed
 * @property string|null $introduction Introduction of the story: 2-3 sentences summary of the case study or success story
 * @property string|null $challenge The problem that was being addressed in the story
 * @property string|null $actions What was done, how, by and with who etc
 * @property string|null $results what changed and what difference was made
 * @property string|null $conclusions Factors that seemed to be critical to achieving the outcomes
 * @property string|null $sequel Summarising what happens next, whether this seems to be the end of the story or whether the programme will continue to track changes
 * @property int $status
 * @property int|null $paio_review_status
 * @property string|null $paio_comments
 * @property int|null $ikmo_review_status
 * @property string|null $ikmo_comments
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property LkmStoryofchangeCategory $category
 * @property LkmStoryofchangeMedia[] $lkmStoryofchangeMedia
 */
class Storyofchange extends \yii\db\ActiveRecord {

    const _status_pending_review_submission = 0;
    const _accepted = 1;
    const _submitted_for_review = 2;
    const _resent_back = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'lkm_storyofchange';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['category_id', 'title', 'interviewee_names', 'interviewer_names', 'date_interviewed', 'status'], 'required'],
            [['category_id', 'status', 'paio_review_status', 'ikmo_review_status', 'created_at',
            'updated_at', 'created_by', 'updated_byfile', 'camp_id', 'district_id', 'province_id'], 'integer'],
            [['title', 'interviewee_names', 'interviewer_names', 'introduction', 'challenge', 'actions', 'results', 'conclusions', 'sequel', 'paio_comments', 'ikmo_comments'], 'string'],
            [['date_interviewed'], 'safe'],
            ['title', 'unique', 'message' => 'Story of change title exist already!'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => LkmStoryofchangeCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'category_id' => 'Story Category',
            'title' => 'Title',
            'interviewee_names' => 'Interviewee Names',
            'interviewer_names' => 'Interviewer Names',
            'date_interviewed' => 'Date of interview',
            'introduction' => 'Introduction',
            'challenge' => 'Challenge',
            'actions' => 'Actions',
            'results' => 'Results',
            'conclusions' => 'Conclusions',
            'sequel' => 'Sequel',
            'status' => 'Status',
            'paio_review_status' => 'PAIO Review Status',
            'paio_comments' => 'PAIO Comments',
            'ikmo_review_status' => 'IKMO Review Status',
            'ikmo_comments' => 'IKMO Comments',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'camp_id' => "Camp",
            'district_id' => "District",
            'province_id' => "Province"
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

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(LkmStoryofchangeCategory::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[LkmStoryofchangeMedia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLkmStoryofchangeMedia() {
        return $this->hasMany(LkmStoryofchangeMedia::className(), ['story_id' => 'id']);
    }

    public static function sendEmail($msg, $subject, $recepientEmail) {
        return Yii::$app->mailer
                        ->compose(
                                ['html' => 'SendMail-html'], ['msg' => $msg]
                        )
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->params['supportEmail']])
                        ->setTo($recepientEmail)
                        ->setSubject($subject)
                        ->send();
    }

}
