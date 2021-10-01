<?php

namespace frontend\models;
use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfDeclaration;

/**
 * MgfDeclarationSearch represents the model behind the search form of `frontend\models\MgfDeclaration`.
 */
class MgfDeclarationSearch extends MgfDeclaration
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rep_aproval', 'project_id', 'created_by', 'updated_by'], 'integer'],
            [['declaration_parta', 'declaration_partb', 'declaration_partc', 'rep_name', 'approval_date', 'rep_title', 'address', 'phone', 'email', 'date_created', 'date_update'], 'safe'],
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
       // $query = MgfDeclaration::find();
       $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfDeclaration::find()->where(['proposal_id'=>$proposal->id]);
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
            'rep_aproval' => $this->rep_aproval,
            'approval_date' => $this->approval_date,
            'project_id' => $this->project_id,
            'date_created' => $this->date_created,
            'date_update' => $this->date_update,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'declaration_parta', $this->declaration_parta])
            ->andFilterWhere(['like', 'declaration_partb', $this->declaration_partb])
            ->andFilterWhere(['like', 'declaration_partc', $this->declaration_partc])
            ->andFilterWhere(['like', 'rep_name', $this->rep_name])
            ->andFilterWhere(['like', 'rep_title', $this->rep_title])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
