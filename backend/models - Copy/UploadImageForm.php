<?php
 namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use common\models\Role;
   use yii\base\Model;
   class UploadImageForm extends Model {
      public $image;
      public function rules() {
         return [
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, png'],
         ];
      }
      public function upload() {
         if ($this->validate()) {
            $this->image->saveAs('../uploads/' . $this->image->baseName . '.' .
               $this->image->extension);
            return true;
         } else {
            return false;
         }
      }
   }
?>