<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
//use borales\extensions\phoneInput\PhoneInputValidator;
use common\models\Role;

/**
 * This is the model class for table "awpb_template".
 *
 * @property int $id
 * @property int $fiscal_year
 * @property string $budget_theme
 * @property string $comment
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
            [['fiscal_year', 'budget_theme', 'comment', 'status', 'created_at', 'updated_at'], 'required'],
            [['fiscal_year', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['budget_theme'], 'string'],
            [['comment'], 'string'],
			[['guideline_file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf'],
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
            'comment' => 'Comment',
			'guideline_file' => 'Guideline file',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
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
	 public function upload()
    {
        if ($this->validate()) {
            $this->guideline_file->saveAs('uploads/' . $this->guideline_file->baseName . '.' . $this->guideline_file->extension);
            return true;
        } else {
            return false;
        }
    }
}
