<<<<<<< HEAD
<?php

namespace frontend\models;
use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfInputItem;

/**
 * MgfInputItemSearch represents the model behind the search form of `frontend\models\MgfInputItem`.
 */
class MgfInputItemSearch extends MgfInputItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'item_no', 'activity_id', 'createdby'], 'integer'],
            [['input_name'], 'string'],
            [['unit_of_measure', 'comment', 'date_created'], 'safe'],
            [['unit_cost', 'total_cost','project_year_1', 'project_year_2', 'project_year_3', 'project_year_4','project_year_5', 'project_year_6', 'project_year_7', 'project_year_8'], 'number'],
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
       // $query = MgfInputItem::find();
       $userid=Yii::$app->user->identity->id;
        $applicant=MgfApplicant::findOne(['user_id'=>$userid]);
        $proposal=MgfProposal::findOne(['organisation_id'=>$applicant->organisation_id,'is_active'=>1]);
        $query = MgfInputItem::find()->where(['proposal_id'=>$proposal->id]);
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
            'item_no' => $this->item_no,
            'input_name' => $this->input_name,
            'project_year_1' => $this->project_year_1,
            'project_year_2' => $this->project_year_2,
            'project_year_3' => $this->project_year_3,
            'project_year_4' => $this->project_year_4,
            'project_year_5' => $this->project_year_5,
            'project_year_6' => $this->project_year_6,
            'project_year_7' => $this->project_year_7,
            'project_year_8' => $this->project_year_8,
            'unit_cost' => $this->unit_cost,
            'total_cost' => $this->total_cost,
            'activity_id' => $this->activity_id,
            'date_created' => $this->date_created,
            'createdby' => $this->createdby,
        ]);

        $query->andFilterWhere(['like', 'unit_of_measure', $this->unit_of_measure])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
=======
<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfInputItem;

/**
 * MgfInputItemSearch represents the model behind the search form of `frontend\models\MgfInputItem`.
 */
class MgfInputItemSearch extends MgfInputItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'item_no', 'activity_id', 'createdby'], 'integer'],
            [['input_name'], 'string'],
            [['unit_of_measure', 'comment', 'date_created'], 'safe'],
            [['unit_cost', 'total_cost','project_year_1', 'project_year_2', 'project_year_3', 'project_year_4','project_year_5', 'project_year_6', 'project_year_7', 'project_year_8'], 'number'],
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
        $query = MgfInputItem::find();

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
            'item_no' => $this->item_no,
            'input_name' => $this->input_name,
            'project_year_1' => $this->project_year_1,
            'project_year_2' => $this->project_year_2,
            'project_year_3' => $this->project_year_3,
            'project_year_4' => $this->project_year_4,
            'project_year_5' => $this->project_year_5,
            'project_year_6' => $this->project_year_6,
            'project_year_7' => $this->project_year_7,
            'project_year_8' => $this->project_year_8,
            'unit_cost' => $this->unit_cost,
            'total_cost' => $this->total_cost,
            'activity_id' => $this->activity_id,
            'date_created' => $this->date_created,
            'createdby' => $this->createdby,
        ]);

        $query->andFilterWhere(['like', 'unit_of_measure', $this->unit_of_measure])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
