<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbComponent;

/**
 * AwpbComponentSearch represents the model behind the search form of `backend\models\AwpbComponent`.
 */
class AwpbComponentSearch extends AwpbComponent
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'access_level','parent_component_id','gl_account_code', 'funder_id', 'type','expense_category_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['code', 'description', 'name', 'outcome', 'output', 'subcomponent'], 'safe'],
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
        $query = AwpbComponent::find();

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
            'parent_component_id' => $this->parent_component_id,
            'type' => $this->type,
            'funder_id' => $this->funder_id,
            'access_level'=>$this->access_level,
            'expense_category_id' => $this->expense_category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'outcome', $this->outcome])
            ->andFilterWhere(['like', 'output', $this->output])
            ->andFilterWhere(['like', 'gl_account_code', $this->gl_account_code])
            ->andFilterWhere(['like', 'subcomponent', $this->subcomponent]);

        return $dataProvider;
    }
}
