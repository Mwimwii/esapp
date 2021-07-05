<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AwpbComponent;

/**
 * AwpbComponentSearch represents the model behind the search form of `app\models\AwpbComponent`.
 */
class AwpbComponentSearch extends AwpbComponent
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parent_component_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['component_code', 'component_description', 'component_outcome', 'component_output'], 'safe'],
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'component_code', $this->component_code])
            ->andFilterWhere(['like', 'component_description', $this->component_description])
            ->andFilterWhere(['like', 'component_outcome', $this->component_outcome])
            ->andFilterWhere(['like', 'component_output', $this->component_output]);

        return $dataProvider;
    }
}
