<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "lkm_storyofchange_interview_guide_template_questions".
 *
 * @property int $id
 * @property string $section
 * @property string $number
 * @property string $question
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class LkmStoryofchangeInterviewGuideTemplateQuestions extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'lkm_storyofchange_interview_guide_template_questions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['section', 'number', 'question'], 'required'],
            [['question'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by', 'number'], 'integer'],
            [['section'], 'string', 'max' => 45],
            ['number', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('number') ? TRUE : FALSE;
                }, 'message' => "Question number already exist under another section"],
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
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'section' => 'Section',
            'number' => 'Question number',
            'question' => 'Question',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public static function getQuestionNumbers() {
        return self::find()->select(['section', 'number'])->orderBy(['number' => SORT_ASC])->all();
        // return ArrayHelper::map($names, 'section', 'number');
    }

    public static function getQuestionNumber() {
        $names = self::find()->orderBy(['number' => SORT_ASC])->all();
        return ArrayHelper::map($names, 'number', 'number');
    }

}
