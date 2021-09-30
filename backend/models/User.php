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
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $role
 * @property int $institution_id
 * @property string $username
 * @property string|null $email
 * @property string $password
 * @property string $auth_key
 * @property string|null $password_reset_token
 * @property string|null $verification_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Institutions $institution
 * @property Role $role0
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface {

    const STATUS_DELETED = 2;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_OUT_OF_OFFICE = 8;

    public $user_type;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['role', 'username', 'first_name', 'last_name', 'auth_key', 'email'], 'required'],
            [['role', 'status', 'camp_id', 'district_id', 'province_id'], 'integer'],
            [['username', 'email', 'other_name', 'first_name', 'last_name',
            'password', 'auth_key', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['title', 'sex', 'nrc', 'type_of_user'], 'string'],
            [['phone'], PhoneInputValidator::className()],
            ['email', 'email', 'message' => "The email isn't correct!"],
            ['email', 'unique', 'when' => function($model) {
                    return $model->isAttributeChanged('email');
                }, 'message' => 'Email already in use!'],
            [['role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'title' => 'Title',
            'sex' => 'Sex',
            'username' => 'Username',
            'other_name' => 'Other names',
            'first_name' => 'First name',
            'last_name' => 'Surname',
            'email' => 'Email',
            'phone' => 'Phone',
            'nrc' => 'NRC',
            'camp_id' => "Camp",
            'district_id' => "District",
            'province_id' => "Province",
            'type_of_user' => "User type",
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'verification_token' => 'Verification Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * Gets query for [[Role0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole0() {
        return $this->hasOne(Role::className(), ['id' => 'role']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        // return static::find()->cache(3600)->where(['id' => $id, 'status' => self::STATUS_ACTIVE])->one();
        return static::find()->where(['id' => $id, 'status' => self::STATUS_ACTIVE])->one();
    }

    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findById($id) {
        return static::findOne(['id' => $id]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_ACTIVE,
        ]);
    }

    public static function findByPasswordResetTokenInactiveAccount($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => self::STATUS_INACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
                    'verification_token' => $token,
                    'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password . $this->auth_key, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password) {
        $this->password = Yii::$app->security->generatePasswordHash($password . $this->auth_key);
    }

    public function setStatus() {
        $this->status = self::STATUS_ACTIVE;
    }

    /**
     * Generates "remember me" authentication key
     * @throws \yii\base\Exception
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     * @throws \yii\base\Exception
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generateEmailVerificationToken() {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }

    public static function userIsAllowedTo($right) {
        $session = Yii::$app->session;
        $rights = explode(',', $session['rights']);
        if (in_array($right, $rights)) {
            return true;
        }
        return false;
    }

    public function getFullName() {
        return ucfirst(strtolower($this->title)) . " " . ucfirst(strtolower($this->first_name)) . " " . ucfirst(strtolower($this->other_name)) . " " . ucfirst(strtolower($this->last_name));
    }

    /**
     * @return array
     */
    public static function getOtherNames() {
        $users = self::find()->orderBy(['other_name' => SORT_ASC])->all();
        $list = ArrayHelper::map($users, 'other_name', 'other_name');
        return $list;
    }

    /**
     * @return array
     */
    public static function getLastNames() {
        $users = self::find()->orderBy(['last_name' => SORT_ASC])->all();
        $list = ArrayHelper::map($users, 'last_name', 'last_name');
        return $list;
    }

    /**
     * @return array
     */
    public static function getUsernames() {
        $users = self::find()
                        ->orderBy(['username' => SORT_ASC])->all();
        $list = ArrayHelper::map($users, 'username', 'username');
        return $list;
    }

    /**
     * 
     * @return type array
     */
    public static function getFullNames() {
        $query = static::find()
                ->select(["CONCAT(CONCAT(CONCAT(title,' ',first_name),' ',other_name),' ',last_name) as name", 'first_name'])
                //->where(["IN", 'status', [self::STATUS_ACTIVE]])
                ->orderBy(['id' => SORT_ASC])
                ->asArray()
                ->all();

        return \yii\helpers\ArrayHelper::map($query, 'first_name', 'name');
    }

    /**
     * @return array
     */
    public static function getActiveUsers() {
        $query = static::find()
                ->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_name),' ',last_name) as name", 'id'])
                ->where(['status' => self::STATUS_ACTIVE])
                ->andWhere(['NOT IN', 'first_name', 'Board'])
                ->orderBy(['username' => SORT_ASC])
                ->asArray()
                ->all();
        return ArrayHelper::map($query, 'id', 'name');
    }

    public static function getUsers() {
        $query = static::find()
                ->select(["CONCAT(CONCAT(first_name,' ',other_name),' ',last_name) as name", 'id'])
                ->where(['status' => self::STATUS_ACTIVE])
                ->andWhere(['NOT IN', "id", [Yii::$app->user->identity->id]])
                ->orderBy(['id' => SORT_ASC])
                ->asArray()
                ->all();
        return ArrayHelper::map($query, 'name', 'name');
    }

    public static function getAwpbTemplateUsers() {

        $query = static::find()
                ->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_name),' ',last_name) as name", 'id'])
                ->where(['status' => self::STATUS_ACTIVE])            
                ->orderBy(['last_name' => SORT_ASC])
                ->asArray()
                ->all();
        return ArrayHelper::map($query, 'id', 'name');
    


    //    $users = self::find()
    //     //->select(["CONCAT(CONCAT(CONCAT(title,'',first_name),' ',other_name),' ',last_name) as name", 'id'])
    //     ->select(["CONCAT(first_name,' ',last_name) as name", 'id'])
    //     ->where(['status' => self::STATUS_ACTIVE])
    //         //->asArray()
    //     ->orderBy(['name' => SORT_ASC])
    //         ->all();
    //     return $users;
    }

   
    /**
     * Function for seeding default system user
     * NOTE:: USER should be removed after an admin user is created
     */
    public static function seedUser() {
        //We check if seed has run already
       // if (empty(Role::findOne(["role" => "Admin"]))) {
            //First we create a role
            $role = new Role();
            $role->role = "Admin";
            $role->active = 1;
            $role->rights = "NA";
            if ($role->save()) {

                //Then we assign the ultimate permissions to the role,
                //The rest is history
                $rights = [
                    "Manage Users", "Manage Roles","View Roles","View Users"
                ];

                $count = 0;
                foreach ($rights as $right) {
                    $right_to_role = new \common\models\RightAllocation();
                    $right_to_role->role = $role->id;
                    $right_to_role->right = $right;
                    $right_to_role->save();
                    $count++;
                }

                //We try to create the user
                echo self::createTempAdminUser($role->id, $count);
            } else {
                $message = "";
                foreach ($role->getErrors() as $error) {
                    $message .= $error[0];
                }
                echo "Error occured while running user seeder. Error:" . $message;
            }
       /* } else {
            echo "User seed has already been run!";
	}*/
    }

    public static function createTempAdminUser($id, $count) {
        // [['role', 'username', 'first_name', 'last_name', 'auth_key', 'email'], 'required'],
        if ($count > 0) {
            $model = new User();
            $model->first_name = 'Please';
            $model->other_name = 'delete';
            $model->last_name = "me";
            $model->email = "admin@emis.com";
            $model->status = self::STATUS_ACTIVE;
            $model->auth_key = Yii::$app->security->generateRandomString();
            //Temp password hash 
            $model->password = Yii::$app->getSecurity()->generatePasswordHash("Q!weRTy@134" . $model->auth_key);
            //Default username to email
            $model->username = $model->email;
            $model->type_of_user = "Other user";
            $model->role = $id;

            if ($model->save()) {
                echo "User seeding was successful!";
            } else {
                $message = "";
                foreach ($model->getErrors() as $error) {
                    $message .= $error[0];
                }
                echo "Error occured while running user seeder. Could not create user.Errors:" . $message;
            }
        } else {
            echo "Error occured while running user seeder. Could not assign permissions to role!";
        }
    }

}
