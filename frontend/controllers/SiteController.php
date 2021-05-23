<?php
namespace frontend\controllers;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Role;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\MgfReviewer;
use frontend\models\ContactForm;
use frontend\models\MgfApplicant;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
        
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex(){
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin(){
        if (!Yii::$app->user->isGuest) {
            $this->layout = 'main';
            return $this->goHome();
        }

        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            $rightsArray = \common\models\RightAllocation::getRights(Yii::$app->getUser()->identity->role);
            $rights = \implode(",", $rightsArray);
            $session = Yii::$app->session;
            $session->set('role', Role::findOne(['id' => Yii::$app->getUser()->identity->role])->role);
            $session->set('rights', $rights);
            $session->set('created_at', $user->created_at);
            return $this->goHome();
        } else {
            $model->password = '';
            $this->layout = 'login';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->redirect(['login']);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup(){
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            $user=User::find()->where(['email'=>$model->email,'username'=>$model->username,'phone'=>$model->phone])->one();
            $applicant=new MgfApplicant();
            $applicant->first_name=$model->first_name;
            $applicant->last_name=$model->last_name;
            $applicant->mobile=$model->phone;
            $applicant->nationalid=$model->nrc;
            $applicant->user_id=$user->id;
            if ($applicant->save()) {
                $user->other_name='';
                $user->save();
                Yii::$app->session->setFlash('success', 'You have Successfully Registered for E-SSAP MGF.<br/>Your Login Username is '.$user['username'].'<br/>Please check your inbox for verification email.');
                return $this->redirect(['/site/login']);
            }else{
                $user->delete();
                Yii::$app->session->setFlash('error', 'Information NOT Saved!!');
            }
        }
        $this->layout = 'signup';
        return $this->render('signup', ['model' => $model,]);
    }


    public function actionCreateReviewer(){
        $model = new MgfReviewer();
        if ($model->load(Yii::$app->request->post())) {
            $userid=Yii::$app->user->identity->id;
            $model->user_id=time();
            $model->createdBy=$userid;
            if($model->save()){
                $user=User::findOne(['email'=>$model->email]);
                MgfReviewer::updateAll(['user_id' => $user->id], 'id='.$model->id);
                $password = Yii::$app->getSecurity()->generatePasswordHash($model->mobile);
                $auth=Yii::$app->security->generateRandomString();
                User::updateAll(['created_at' =>time(),'updated_at'=>time(),'created_by'=>$userid,'auth_key'=>$auth,'password'=>$password], 'id='.$user->id);
                $this->sendEmail($user);
                Yii::$app->session->setFlash('success', 'Saved successfully.'.$user->setPassword($user->phone));
                return $this->redirect(['/mgf-proposal/reviewers']);
            }else{
                Yii::$app->session->setFlash('error', 'NOT Saved1:');
                return $this->redirect(['/mgf-proposal/reviewers']);
            }
        } return $this->redirect(['/mgf-proposal/reviewers']);
    }


    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset(){
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        $this->layout = 'login';
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token){
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        $this->layout = 'login';
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token){
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail(){
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        $this->layout = 'login';
        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
