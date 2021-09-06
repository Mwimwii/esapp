<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfApplication;
use Yii;
/**
 * MgfApplicationSearch represents the model behind the search form of `frontend\models\MgfApplication`.
 */
class MgfApplicationSearch extends MgfApplication
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'attachements', 'applicant_id', 'organisation_id'], 'integer'],
            [['application_status', 'date_created', 'date_submitted'], 'safe'],
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
            $query = MgfApplication::find()->joinWith('applicant')->where(['province_id'=>$provinceid]);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfApplication::find()->joinWith('applicant')->where(['district_id'=>$districtid]);
        }else if($usertype=="National user") {
            $query = MgfApplication::find();
        }else if($usertype=="Applicant") {
            $userid=Yii::$app->user->identity->id;
            $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
            $query = MgfApplication::find()->where(['applicant_id'=>$applicant->id]);
        }else{
            $query = MgfApplication::find();
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['is_active' => SORT_DESC]],
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
            'attachements' => $this->attachements,
            'applicant_id' => $this->applicant_id,
            'is_active'=>$this->is_active,
            'application_status'=>$this->application_status,
            'organisation_id' => $this->organisation_id,
            'date_created' => $this->date_created,
            'date_submitted' => $this->date_submitted,
        ]);

        $query->andFilterWhere(['like', 'application_status', $this->application_status])
            ->andFilterWhere(['like','is_active', $this->is_active])
            ->andFilterWhere(['like', 'organisation_id', $this->organisation_id]);

        return $dataProvider;
    }


    public function searchApplications($params){
        $usertype=Yii::$app->user->identity->type_of_user;
        if ($usertype=="Provincial user") {
            $provinceid=Yii::$app->user->identity->province_id;
            $query = MgfApplication::find()->joinWith('applicant')->where(['province_id'=>$provinceid])->where(['application_status'=>'Submitted'])->orWhere(['application_status'=>'Under_Review']);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfApplication::find()->joinWith('applicant')->where(['district_id'=>$districtid])->where(['application_status'=>'Submitted'])->orWhere(['application_status'=>'Under_Review']);
        }else if($usertype=="National user") {
            $query = MgfApplication::find();
        }else{
            $query = MgfApplication::find()->where(['application_status'=>'Submitted'])->orWhere(['application_status'=>'Under_Review']);
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
            'attachements' => $this->attachements,
            'applicant_id' => $this->applicant_id,
            'application_status'=>$this->application_status,
            'organisation_id' => $this->organisation_id,
            'date_created' => $this->date_created,
            'date_submitted' => $this->date_submitted,
        ]);

        $query->andFilterWhere(['like', 'application_status', $this->application_status])
            ->andFilterWhere(['like', 'organisation_id', $this->organisation_id]);

        return $dataProvider;
    }
}
