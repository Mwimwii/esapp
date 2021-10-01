<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use borales\extensions\phoneInput\PhoneInputValidator;
use common\models\Role;

/**
 * This is the model class for table "awpb_template_users".
 *
 * @property int $id
 * @property int $user_id
 * @property int $awpb_template_id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $other_name
 * @property int|null $updated_by
 * @property int|null $created_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Users $user
 * @property AwpbTemplate $awpbTemplate
 */
class AwpbTemplateUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const STATUS_DRAFT = 0;
    const STATUS_SUBMITTED = 1;
    const STATUS_REVIEWED = 2;
    const STATUS_APPROVED = 3;
    const STATUS_MINISTRY = 4;
    
    public static function tableName()
    {
        return 'awpb_template_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'awpb_template_id', 'first_name', 'last_name'], 'required'],
            [['user_id', 'awpb_template_id','status_budget', 'updated_by', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'other_name'], 'string', 'max' => 255],
            [['title'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['awpb_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => AwpbTemplate::className(), 'targetAttribute' => ['awpb_template_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'awpb_template_id' => 'Awpb Template ID',
            'status_budget'=>'Budget Status',
            'title' => 'Title',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'other_name' => 'Other Name',
            'updated_by' => 'Updated By',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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

    /**
     * Gets query for [[AwpbTemplate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAwpbTemplate()
    {
        return $this->hasOne(AwpbTemplate::className(), ['id' => 'awpb_template_id']);
    }

    public static function getTemplateUsers($template_id) {
         $query =  self::find() 
        ->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_name),' ',last_name) as last_name", 'user_id as id'])
        ->where(['awpb_template_id'=>$template_id])        
        ->orderBy(['last_name' => SORT_ASC])
        ->all();
    return $query;

    }
 

}
