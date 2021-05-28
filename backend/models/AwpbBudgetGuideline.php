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
class AwpbBudgetGuideline extends \yii\db\ActiveRecord {
   
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_CURRENT_BUDGET = 2;
    const STATUS_OLD_BUDGET = 3;
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'awpb_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {

        return [
        
        	[['fiscal_year', 'budget_theme', 'guideline_file','status'], 'required'],
            [['fiscal_year', 'status', 'created_at','created_by', 'updated_at','updated_by'], 'integer'],
            [['budget_theme'], 'string'],
            [['guideline_file'], 'string', 'max' => 255],
            [['fiscal_year'], 'unique'],
           
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
             'id' => 'ID',
            'fiscal_year' => 'Fiscal Year',
            'budget_theme' => 'Budget Theme',     
            'guideline_file' => 'Guideline File',
			 'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By'
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
    

}
