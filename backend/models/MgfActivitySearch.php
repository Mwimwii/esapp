<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfActivity;

/**
 * MgfActivitySearch represents the model behind the search form of `frontend\models\MgfActivity`.
 */
class MgfActivitySearch extends MgfActivity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'activity_no', 'componet_id', 'createdby','inputs'], 'integer'],
            [['activity_name'], 'string'],
            [['date_created'], 'safe'],
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
        $query = MgfActivity::find();

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
            'activity_no' => $this->activity_no,
            'activity_name' => $this->activity_name,
            'componet_id' => $this->componet_id,
            'date_created' => $this->date_created,
            'createdby' => $this->createdby,
            'inputs' => $this->inputs,
        ]);

        return $dataProvider;
    }
}
