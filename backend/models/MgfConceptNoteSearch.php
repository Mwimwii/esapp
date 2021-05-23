<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MgfConceptNote;
use Yii;
/**
 * MgfConceptNoteSearch represents the model behind the search form of `frontend\models\MgfConceptNote`.
 */
class MgfConceptNoteSearch extends MgfConceptNote{
    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['id', 'operation_id', 'implimentation_period', 'application_id', 'organisation_id'], 'integer'],
            [['project_title', 'starting_date', 'other_operation_type', 'date_created', 'date_submitted'], 'safe'],
            [['estimated_cost'], 'number'],
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
            $query = MgfConceptNote::find()->joinWith('organisation')->where(['province_id'=>$provinceid]);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfConceptNote::find()->joinWith('organisation')->where(['district_id'=>$districtid]);
        }else if($usertype=="National user") {
            $query = MgfConceptNote::find();
        }else if($usertype=="Applicant") {
            $userid=Yii::$app->user->identity->id;
            $applicant=MgfApplicant::find()->where(['user_id'=>$userid])->one();
            $query = MgfConceptNote::find()->where(['organisation_id'=>$applicant->organisation_id]);
        }else{
            $query = MgfConceptNote::find();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
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
            'estimated_cost' => $this->estimated_cost,
            'starting_date' => $this->starting_date,
            'operation_id' => $this->operation_id,
            'implimentation_period' => $this->implimentation_period,
            'application_id' => $this->application_id,
            'organisation_id' => $this->organisation_id,
            'date_created' => $this->date_created,
            'date_submitted' => $this->date_submitted,
        ]);

        $query->andFilterWhere(['like', 'project_title', $this->project_title])
            ->andFilterWhere(['like', 'other_operation_type', $this->other_operation_type]);

        return $dataProvider;
    }
}
