<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "awpb_comment".
 *
 * @property int $id
 * @property int $awpb_template_id
 * @property int|null $district_id
 * @property int|null $province_id
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class AwpbComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'awpb_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['awpb_template_id', 'activity_id', 'description'], 'required'],
            [['awpb_template_id', 'activity_id','district_id', 'province_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['description'], 'string'],
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


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'awpb_template_id' => 'Awpb Template ID',
            'activity_id'=>'Activity',
            'district_id' => 'District ID',
            'province_id' => 'Province ID',
            'description' => 'Comment',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
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
