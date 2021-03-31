<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "lkm_storyofchange_article".
 *
 * @property int $id
 * @property int|null $story_id
 * @property string|null $article_type
 * @property string|null $description
 * @property string $file
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class LkmStoryofchangeArticle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lkm_storyofchange_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['story_id', 'file'], 'required'],
            [['story_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['description','file_name'], 'string'],
            [['article_type', 'file'], 'string', 'max' => 255],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'story_id' => 'Story ID',
            'article_type' => 'Article Type',
            'description' => 'Description',
            'file' => 'File',
            'file_name' => 'File name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
