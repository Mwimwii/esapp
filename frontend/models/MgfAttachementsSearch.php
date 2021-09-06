<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfAttachements;
use Yii;
/**
 * MgfAttachementsSearch represents the model behind the search form of `frontend\models\MgfAttachements`.
 */
class MgfAttachementsSearch extends MgfAttachements{
    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['id', 'application_id'], 'integer'],
            [['registration_certificate', 'articles_of_assoc', 'audit_reports', 'mou_contract', 'board_resolution', 'application_attachement', 'date_created'], 'safe'],
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
            $query = MgfAttachements::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.province_id'=>$provinceid]);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfAttachements::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid]);
        }else if($usertype=="National user") {
            $query = MgfAttachements::find()->joinWith('applicant')->joinWith('mgfApplications')->joinWith('province')->joinWith('district');
        }else if($usertype=="Applicant") {
            $userid=Yii::$app->user->identity->id;
            $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
            if (!MgfApplication::find()->where(['organisation_id'=>$applicant->organisation_id,'is_active'=>1])->exists()){
                $application=new MgfApplication();
                $application->organisation_id=$applicant->organisation_id;
                $application->applicant_id=$applicant->id;
                $application->is_active=1;
                $application->save();
            }
            $query = MgfAttachements::find()->where(['organisation_id'=>$applicant->organisation_id]);
        }else{
            $query = MgfAttachements::find()->joinWith('organisation')->joinWith('application');
        }
        //$query = MgfAttachements::find();

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
            'application_id' => $this->application_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'registration_certificate', $this->registration_certificate])
            ->andFilterWhere(['like', 'articles_of_assoc', $this->articles_of_assoc])
            ->andFilterWhere(['like', 'audit_reports', $this->audit_reports])
            ->andFilterWhere(['like', 'mou_contract', $this->mou_contract])
            ->andFilterWhere(['like', 'board_resolution', $this->board_resolution])
            ->andFilterWhere(['like', 'application_attachement', $this->application_attachement]);

        return $dataProvider;
    }
}
