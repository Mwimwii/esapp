<?php
use frontend\models\MgfApplicant;
$isGuest = Yii::$app->user->isGuest;
if($isGuest){
    echo '<script>location.href="index.php?r=site/login"</script>';
}else{
    $userid=Yii::$app->user->identity->id;
    if (MgfApplicant::find()->where(['user_id'=>$userid])->exists()) {
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        if ($applicant->district_id>0) {
            echo '<script>location.href="index.php?r=mgf-applicant/profile"</script>';
        }else{
            echo '<script>location.href="index.php?r=mgf-applicant%2Fupdate&id='.$applicant->id.'"</script>';
        }
    }
}
?>