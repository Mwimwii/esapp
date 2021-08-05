<?php

namespace frontend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "mgf_approval_status".
 *
 * @property int $id
 * @property string|null $approval_status
 * @property string $lowerlimit
 * @property string $upperlimit
 * @property int $user_id
 * @property string $date_created
 *
 * @property Users $user
 */
class MgfApprovalStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_approval_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['approval_status'], 'string'],
            [['lowerlimit', 'upperlimit', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['date_created'], 'safe'],
            [['lowerlimit', 'upperlimit'], 'string', 'max' => 5],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'approval_status' => 'Approval Status',
            'lowerlimit' => 'Lowerlimit',
            'upperlimit' => 'Upperlimit',
            'user_id' => 'User ID',
            'date_created' => 'Date Created',
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
}
