<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MgfContact;

/**
 * MgfContactSearch represents the model behind the search form of `frontend\models\MgfContact`.
 */
class MgfContactSearch extends MgfContact
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'organisation_id', 'position_id', 'applicant_id'], 'integer'],
            [['first_name', 'last_name', 'mobile', 'tel_no', 'physical_address', 'date_created'], 'safe'],
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
        $query = MgfContact::find();

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
            'position_id' => $this->position_id,
            'applicant_id' => $this->applicant_id,
            'date_created' => $this->date_created,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no])
            ->andFilterWhere(['like', 'physical_address', $this->physical_address]);

        return $dataProvider;
    }
}
