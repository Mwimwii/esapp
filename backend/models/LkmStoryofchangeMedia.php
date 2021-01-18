<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "lkm_storyofchange_media".
 *
 * @property int $id
 * @property int $story_id
 * @property string $media_type
 * @property string $media_path
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property LkmStoryofchange $story
 */
class LkmStoryofchangeMedia extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'lkm_storyofchange_media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['story_id', 'media_type', 'file', 'file_name'], 'required'],
            [['story_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['media_type'], 'string'],
            // [['media_path'], 'string', 'max' => 255],
            [['story_id'], 'exist', 'skipOnError' => true, 'targetClass' => Storyofchange::className(), 'targetAttribute' => ['story_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'story_id' => 'Story Title',
            'media_type' => 'Media Type',
            'file_name' => "File name",
            'file' => 'File',
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

    /**
     * Gets query for [[Story]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStory() {
        return $this->hasOne(Storyofchange::className(), ['id' => 'story_id']);
    }

}
