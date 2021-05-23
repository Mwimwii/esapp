<?php

namespace frontend\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfApplicant;

/**
 * MgfApplicantSearch represents the model behind the search form of `frontend\models\MgfApplicant`.
 */
class MgfApplicantSearch extends MgfApplicant
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'province_id', 'district_id', 'user_id', 'organisation_id'], 'integer'],
            [['title', 'first_name', 'last_name', 'mobile', 'nationalid', 'address', 'applicant_type', 'date_created'], 'safe'],
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
            $query = MgfApplicant::find()->joinWith('user')->joinWith('province')->joinWith('district')->where(['mgf_applicant.province_id'=>$provinceid]);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfApplicant::find()->joinWith('user')->joinWith('province')->joinWith('district')->where(['mgf_applicant.district_id'=>$districtid]);
        }else if($usertype=="National user") {
            $query = MgfApplicant::find()->joinWith('user')->joinWith('province')->joinWith('district');
        }else{
            $query = MgfApplicant::find()->joinWith('user')->joinWith('province')->joinWith('district');
        }
        //$query = MgfApplicant::find();

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
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'user_id' => $this->user_id,
            'organisation_id' => $this->organisation_id,
            'date_created' => $this->date_created,
            'confirmed'=>$this->confirmed,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'mobile', $this->confirmed])
            ->andFilterWhere(['like', 'nationalid', $this->nationalid])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'applicant_type', $this->applicant_type]);

        return $dataProvider;
    }
}
