<?php
use frontend\models\MgfOrganisation;

//Restrict User Not to view records for other Organisations
function getOrganisationID(){
    $usertype=Yii::$app->user->identity->type_of_user;
    if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $model = MgfOrganisation::find()->joinWith('applicant')->joinWith('province')->joinWith('district')->where(['mgf_applicant.province_id'=>$provinceid])->one();
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $model = MgfOrganisation::find()->joinWith('applicant')->joinWith('province')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid])->one();
        }else if($usertype=="National user") {
            $model = MgfOrganisation::find()->joinWith('applicant')->joinWith('province')->joinWith('district')->one();
        }else if($usertype=="Applicant") {
            $userid=Yii::$app->user->id;
            $model = MgfOrganisation::find()->joinWith('applicant')->where(['user_id'=>$userid])->one();
        }else{
            $model = MgfOrganisation::find()->joinWith('applicant')->joinWith('province')->joinWith('district')->one();
        }
        $modelid=$model->id;
        return $modelid;
    }

?>