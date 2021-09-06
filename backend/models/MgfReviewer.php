<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_reviewer".
 *
 * @property int $id
 * @property string|null $title
 * @property string $login_code
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile
 * @property string|null $reviewer_type
 * @property string area_of_expertise
 * @property int $user_id
 * @property int|null $confirmed
 * @property int|null $createdBy
 * @property int|null $total_assigned_1
 * @property int|null $total_assigned_2
 * @property string $email
 * @property string $date_created
 */
class MgfReviewer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_reviewer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['title', 'reviewer_type','area_of_expertise'], 'string'],

            [['login_code','first_name', 'last_name', 'mobile', 'user_id', 'email'], 'required'],
            [['user_id', 'confirmed', 'createdBy', 'total_assigned_1', 'total_assigned_2'], 'integer'],
            [['date_created','area_of_expertise','reviewer_type'], 'safe'],
            [['login_code'], 'string', 'max' => 50],
            [['first_name', 'last_name'], 'string', 'max' => 30],
            [['mobile'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 50],
            [['login_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'login_code' => 'Login Code',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'mobile' => 'Mobile',
            'reviewer_type' => 'Reviewer Type',
            'area_of_expertise'=>'Area Of Expertise',
            'user_id' => 'User',
            'confirmed' => 'Confirmed',
            'createdBy' => 'Created By',
            'total_assigned_1' => 'Total Assigned 1',
            'total_assigned_2' => 'Total Assigned 2',
            'email' => 'Email',
            'date_created' => 'Date Created',
        ];
    }
}
