<?php
use frontend\models\MgfApplicant;
$usertype=Yii::$app->user->identity->type_of_user;
$userid=Yii::$app->user->identity->id;

if (MgfApplicant::find()->where(['user_id'=>$userid])->exists()) {
    $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
    if ($applicant->district_id>0) {
        include('profile.php');
    }else{
		echo '<script>location.href="index.php?r=mgf-applicant%2Fupdate&id='.$applicant->id.'"</script>';
	}
}else{
    include('mgfmenu.php');
}
?>