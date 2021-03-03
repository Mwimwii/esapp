<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use common\models\Role;

/**
 * This is the model class for table "awpb_template".
 *
 * @property int $id
 * @property int $fiscal_year
 * @property string $budget_theme
 * @property string $comment
 * @property string|null $guideline_file
 * @property int $status 0 Closed, 1 open, 2 Blockedsed
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class AwpbTemplate extends \yii\db\ActiveRecord
{
	const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DISTRICT = 0;
    const STATUS_PROVINCIAL = 1;
    const STATUS_PROGRAMME = 2;
    const STATUS_MINISTRY = 3;
    const STATUS_APROVED = 4;
    const STATUS_OLD = 5;
    /**
     * {@inheritdoc}
     */
	 //public $guideline_doc;
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
            [['fiscal_year', 'budget_theme', 'comment', 'status'], 'required'],
            [['fiscal_year', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['budget_theme', 'comment'], 'string'],
           // [['guideline_file'], 'string', 'max' => 255],
			[['guideline_file'], 'file',  'extensions' => 'pdf'],         
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
            'guideline_file' => 'Guidelines',
			//'guideline_doc' => 'Guideline File',
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

    public static function getAwpbTemplates() {
        $data = self::find()->orderBy(['fiscal_year' => SORT_ASC])
        ->where(['status'=>self::STATUS_ACTIVE])
        ->all();
        $list = ArrayHelper::map($data, 'id', 'fiscal_year');
        return $list;
    }
	/* public function upload()
    {
        if ($this->validate()) {
            $this->guideline_doc->saveAs('uploads/' . $this->guideline_doc->baseName . '.' . $this->guideline_doc->extension);
            return true;
        } else {
            return false;
        }
    }*/
}
