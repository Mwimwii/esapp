<?php

namespace backend\models;

use kartik\password\StrengthValidator;
use yii\base\Model;
use yii\base\InvalidParamException;
use backend\models\Users;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model {

    public $password;
    public $confirm_password;
    public $username;

    /**
     * @var \common\models\User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $config = []) {
        if (empty($token) || !is_string($token)) {
            Yii::$app->session->setFlash('error', 'Your token has expired. Please request for a new one again!.');
            //throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!empty($this->_user)) {
            $this->username = $this->_user->email;
        }
        if (!$this->_user) {
            // throw new InvalidParamException('Wrong password reset token.');
            Yii::$app->session->setFlash('error', 'Your token has expired. Please request for a new one again!.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    /* public function rules() {
      return [
      ['password', 'string', 'min' => 8, 'message' => "password must have 8 characters minimum"],
      ['password', 'match', 'pattern' => '/^.*(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' => 'Password must contain atleast a lower & upper case character, a special case and a digit'],
      ['confirm_password', 'string', 'min' => 8, 'message' => "Confirm password must have 8 characters minimum"],
      ['password', 'required'],
      ['confirm_password', 'string', 'min' => 8],
      ['confirm_password', 'required'],
      ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords do not match!"]
      ];
      } */

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            ['password', 'required'],
            ['password', 'string'],
            [['password'], StrengthValidator::className(), 'preset' => 'fair', 'userAttribute' => 'username'],
            ['confirm_password', 'string'],
            ['confirm_password', 'required'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords do not match!"]
        ];
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword() {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }

}
