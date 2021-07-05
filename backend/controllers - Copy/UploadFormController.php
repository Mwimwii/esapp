<?php
namespace backend\controllers;

use Yii;
use backend\models\UploadForm;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use backend\models\AuditTrail;
use backend\models\User;



class UploadFormController extends Controller
{
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {                
                $model->file->saveAs('backend/web/uploads/' . $model->file->baseName . '.' . $model->file->extension);
            }
        }
		//return $this->redirect(['upload-form/view']);
        //return $this->render('upload-form', ['model' => $model]);
		return $this->redirect(['upload-form/view', 'id' => $model->id]);
    }
}
?>