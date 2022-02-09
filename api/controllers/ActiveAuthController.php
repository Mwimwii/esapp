<?php

namespace api\controllers;

use yii\rest\ActiveController;
use backend\models\User;
use yii\filters\auth\HttpBasicAuth;

/**
 * ActiveAuthController authenticates the controller via basic authentication
 */
// crete abstract class
class  ActiveAuthController extends ActiveController {
    // /**
    //  * {@inheritdoc}
    //  */
    // public function behaviors()
    // {
    //     $behaviors = parent::behaviors();
    //     $behaviors['authenticator'] = [
    //         'class' => HttpBasicAuth::class,
    //         'auth' => function ($username, $password) {
    //             $user = User::find()->where(['username' => $username])->one();
    //             if ($user->validatePassword($password)) {
    //             return $user;
    //             }
    //             return null;
    //             },
    //     ];
    //     return $behaviors;
    // }
}