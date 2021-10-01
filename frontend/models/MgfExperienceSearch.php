<?php

namespace frontend\models;
use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfExperience;

/**
 * MgfExperienceSearch represents the model behind the search form of `frontend\models\MgfExperience`.
 */
class MgfExperienceSearch extends MgfExperience
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','organisation_id'], 'integer'],
            [['financed_before', 'any_collaboration', 'collaboration_will', 'collaboration_ready','date_created'], 'safe'],
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
    public function search($params)
    {
        $query = MgfExperience::find();
       /* $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfExperience::find()->where(['proposal_id'=>$proposal->id]); */
        //$query = MgfImplementationSchedule::find();

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
            'organisation_id' => $this->organisation_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'financed_before', $this->financed_before])
            ->andFilterWhere(['like', 'any_collaboration', $this->any_collaboration])
            ->andFilterWhere(['like','collaboration_ready',$this->collaboration_ready])
            ->andFilterWhere(['like', 'collaboration_will', $this->collaboration_will]);
        return $dataProvider;
    }
}
