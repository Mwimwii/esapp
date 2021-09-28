<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

//use backend\models\User;

use common\models\Role;


/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $first_name;
    public $last_name;
    public $other_name;
    public $phone;
    public $nrc;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['first_name', 'required'],
            ['last_name', 'required'],
            ['phone', 'required'],
            ['nrc', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['other_name', 'required'],
            ['password', 'string', 'min' => 5],
            //['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup(){
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $role=Role::findOne(['role'=>'Applicant']);
        $user->username = $this->username;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->other_name = $this->other_name;
        $user->nrc = $this->nrc;
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->role = $role->id;
        $user->type_of_user='Applicant';
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        if($this->password==$this->other_name){
            return $user->save() && $this->sendEmail($user);
        }else{
            Yii::$app->session->setFlash('error', 'Passwords DO NOT match');
        }
    }

    public function attributeLabels(){
        return [
            'other_name' => 'Confirm Password',
            'nrc'=>'NRC',
        ];
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    public function sendEmail($user){
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
