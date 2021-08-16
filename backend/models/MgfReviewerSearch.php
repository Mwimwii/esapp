<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfReviewer;

/**
 * MgfReviewerSearch represents the model behind the search form of `frontend\models\MgfReviewer`.
 */
class MgfReviewerSearch extends MgfReviewer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'confirmed', 'createdBy', 'total_assigned_1', 'total_assigned_2'], 'integer'],
            [['title', 'login_code', 'first_name', 'last_name', 'mobile', 'reviewer_type', 'area_of_expertise', 'email', 'date_created'], 'safe'],
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
        $query = MgfReviewer::find();

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
            'user_id' => $this->user_id,
            'confirmed' => $this->confirmed,
            'createdBy' => $this->createdBy,
            'total_assigned_1' => $this->total_assigned_1,
            'total_assigned_2' => $this->total_assigned_2,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'login_code', $this->login_code])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'reviewer_type', $this->reviewer_type])
            ->andFilterWhere(['like', 'area_of_expertise', $this->area_of_expertise])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
