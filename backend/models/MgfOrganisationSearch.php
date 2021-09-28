<?php

namespace backend\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MgfOrganisation;
use yii\helpers\ArrayHelper;

/**
 * MgfOrganisationSearch represents the model behind the search form of `frontend\models\MgfOrganisation`.
 */
class MgfOrganisationSearch extends MgfOrganisation
{
    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['id', 'applicant_id','province_id','district_id'], 'integer'],
            [['cooperative', 'acronym', 'registration_type', 'registration_no', 'trade_license_no', 'registration_date', 'business_objective', 'email_address', 'physical_address', 'tel_no', 'date_created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('province')->where(['mgf_applicant.province_id'=>$provinceid]);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('province')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid]);
        }else if($usertype=="National user") {
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('province')->joinWith('district');
        }else if($usertype=="Applicant") {
            $userid=Yii::$app->user->identity->id;
            $query = MgfOrganisation::find()->joinWith('applicant')->where(['user_id'=>$userid,'is_active'=>1]);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('province')->joinWith('district');
        }
        //$query = MgfOrganisation::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }


    public function searchApplicationsAll($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.province_id'=>$provinceid]);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid]);
        }else if($usertype=="National user") {
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district');
        }else if($usertype=="Applicant") {
            $userid=Yii::$app->user->identity->id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['user_id'=>$userid,'is_active'=>1]);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications');
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }
    

    public function searchApplications($params){
        $usertype=Yii::$app->user->identity->type_of_user;
       if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid,'application_status'=>'Submitted'])->orWhere(['mgf_applicant.district_id'=>$districtid,'application_status'=>'Under_Review']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Submitted'])->orWhere(['application_status'=>'Under_Review']);
            //$query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Initialized']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }


    public function searchSentBack($params){
        $usertype=Yii::$app->user->identity->type_of_user;
       if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid,'application_status'=>'Sent-Back']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Sent-Back'])->orWhere(['application_status'=>'Not-Approved']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }

    public function searchSentBack1($params){
        $usertype=Yii::$app->user->identity->type_of_user;
       if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid,'application_status'=>'Sent-Back','mgf_applicant.applicant_type'=>'Category-A'])->orWhere(['mgf_applicant.district_id'=>$districtid,'application_status'=>'Not-Approved','mgf_applicant.applicant_type'=>'Category-A']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Sent-Back','mgf_applicant.applicant_type'=>'Category-A'])->orWhere(['application_status'=>'Not-Approved','mgf_applicant.applicant_type'=>'Category-A']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }


    public function searchSentBack2($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid,'application_status'=>'Sent-Back','mgf_applicant.applicant_type'=>'Category-B'])->orWhere(['mgf_applicant.district_id'=>$districtid,'application_status'=>'Not-Approved','mgf_applicant.applicant_type'=>'Category-B']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Sent-Back','mgf_applicant.applicant_type'=>'Category-B'])->orWhere(['application_status'=>'Not-Approved','mgf_applicant.applicant_type'=>'Category-B']);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }


    public function searchApplicationsWindow1($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid,'application_status'=>'Submitted','mgf_applicant.applicant_type'=>'Category-A'])->orWhere(['mgf_applicant.district_id'=>$districtid,'application_status'=>'Under_Review','mgf_applicant.applicant_type'=>'Category-A']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['application_status'=>'Submitted','mgf_applicant.applicant_type'=>'Category-A'])->orWhere(['application_status'=>'Under_Review','mgf_applicant.applicant_type'=>'Category-A']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }

    public function searchApplicationsWindow2($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid,'application_status'=>'Submitted','mgf_applicant.applicant_type'=>'Category-B'])->orWhere(['mgf_applicant.district_id'=>$districtid,'application_status'=>'Under_Review','mgf_applicant.applicant_type'=>'Category-B']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['application_status'=>'Submitted','mgf_applicant.applicant_type'=>'Category-B'])->orWhere(['application_status'=>'Under_Review','mgf_applicant.applicant_type'=>'Category-B']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }


    public function searchApplicationsAccepted($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->where(['mgf_applicant.province_id'=>$provinceid])->where(['application_status'=>'Compliant']);
         }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Compliant']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }


    public function searchApplicationsRejected($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->where(['mgf_applicant.province_id'=>$provinceid])->where(['application_status'=>'Non-Compliant']);
         }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Non-Compliant']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }

    public function searchApplicationsAccepted1($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->where(['mgf_applicant.province_id'=>$provinceid,'application_status'=>'Compliant','mgf_applicant.applicant_type'=>'Category-A']);
         }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Compliant','mgf_applicant.applicant_type'=>'Category-A']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }

    public function searchApplicationsAccepted2($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->where(['mgf_applicant.province_id'=>$provinceid])->where(['application_status'=>'Compliant','mgf_applicant.applicant_type'=>'Category-B']);
         }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Compliant','mgf_applicant.applicant_type'=>'Category-B']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }


    public function searchApplicationsRejected1($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->where(['mgf_applicant.province_id'=>$provinceid,'application_status'=>'Non-Compliant','mgf_applicant.applicant_type'=>'Category-A']);
         }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Non-Compliant','mgf_applicant.applicant_type'=>'Category-A']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }

    public function searchApplicationsRejected2($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->where(['mgf_applicant.province_id'=>$provinceid])->where(['application_status'=>'Non-Compliant','mgf_applicant.applicant_type'=>'Category-B']);
         }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Non-Compliant','mgf_applicant.applicant_type'=>'Category-B']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }



    public function searchApplicationsCertified($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Other user") {
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Confirmed']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Confirmed']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }

    public function searchApplicationsCertified1($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Other user") {
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Confirmed','mgf_applicant.applicant_type'=>'Category-A']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Confirmed','mgf_applicant.applicant_type'=>'Category-A']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }

    public function searchApplicationsCertified2($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Other user") {
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Confirmed','mgf_applicant.applicant_type'=>'Category-B']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Confirmed','mgf_applicant.applicant_type'=>'Category-B']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }



    public function searchApplicationsUncertified($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Other user") {
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Not-Confirmed']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Not-Confirmed']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }

    public function searchApplicationsUncertified1($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Other user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Not-Confirmed','mgf_applicant.applicant_type'=>'Category-A']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Not-Confirmed','mgf_applicant.applicant_type'=>'Category-A']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }

    public function searchApplicationsUncertified2($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Other user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Not-Confirmed','mgf_applicant.applicant_type'=>'Category-B']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Not-Confirmed','mgf_applicant.applicant_type'=>'Category-B']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }



    public function searchApplicationsApproved($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.province_id'=>$provinceid])->where(['application_status'=>'Approved']);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid])->where(['application_status'=>'Approved']);
        }else if($usertype=="National user") {
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['application_status'=>'Approved']);
        }else if($usertype=="Applicant") {
            $userid=Yii::$app->user->identity->id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['user_id'=>$userid,'is_active'=>1])->where(['application_status'=>'Approved']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Approved']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }



    public function searchApplicationsApproved22($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.province_id'=>$provinceid])->where(['application_status'=>'Approved']);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid])->where(['application_status'=>'Approved']);
        }else if($usertype=="National user") {
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['application_status'=>'Approved']);
        }else if($usertype=="Applicant") {
            $userid=Yii::$app->user->identity->id;
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['user_id'=>$userid,'is_active'=>1])->where(['application_status'=>'Approved']);
        }else{
            $query = MgfOrganisation::find()->joinWith('applicant')->joinWith('mgfApplications')->where(['application_status'=>'Approved']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'registration_date' => $this->registration_date,
            'applicant_id' => $this->applicant_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'cooperative', $this->cooperative])
            ->andFilterWhere(['like', 'acronym', $this->acronym])
            ->andFilterWhere(['like', 'registration_type', $this->registration_type])
            ->andFilterWhere(['like', 'registration_no', $this->registration_no])
            ->andFilterWhere(['like', 'trade_license_no', $this->trade_license_no])
            ->andFilterWhere(['like', 'business_objective', $this->business_objective])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'province_id', $this->province_id])
            ->andFilterWhere(['like', 'district_id', $this->district_id])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no]);
        return $dataProvider;
    }
}
