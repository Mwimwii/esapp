<<<<<<< HEAD
<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfComponent;
use Yii;
/**
 * MgfComponentSearch represents the model behind the search form of `frontend\models\MgfComponent`.
 */
class MgfComponentSearch extends MgfComponent
{
    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['id', 'component_no', 'proposal_id', 'createdby','activities'], 'integer'],
            [['component_name'], 'string'],
            [['date_created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(){
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
            $query = MgfComponent::find()->joinWith('proposal')->where(['province_id'=>$provinceid]);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfComponent::find()->joinWith('proposal')->where(['district_id'=>$districtid]);
        }else if($usertype=="National user") {
            $query = MgfComponent::find();
        }else if($usertype=="Applicant") {
            $userid=Yii::$app->user->identity->id;
            $query = MgfComponent::find()->where(['createdby'=>$userid]);
        }else{
            $query = MgfComponent::find()->joinWith('proposal');
        }
        
        //$query = MgfComponent::find();

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
            'component_no' => $this->component_no,
            'component_name' => $this->component_name,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'activities'=>$this->activities,
            'createdby' => $this->createdby,
        ]);

        return $dataProvider;
    }
}
=======
<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\MgfComponent;
use Yii;
/**
 * MgfComponentSearch represents the model behind the search form of `frontend\models\MgfComponent`.
 */
class MgfComponentSearch extends MgfComponent
{
    /**
     * {@inheritdoc}
     */
    public function rules(){
        return [
            [['id', 'component_no', 'proposal_id', 'createdby','activities'], 'integer'],
            [['component_name'], 'string'],
            [['date_created'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(){
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
            $query = MgfComponent::find()->joinWith('proposal')->where(['province_id'=>$provinceid]);
        }else if($usertype=="District user") {
            $districtid=Yii::$app->user->identity->district_id;
            $query = MgfComponent::find()->joinWith('proposal')->where(['district_id'=>$districtid]);
        }else if($usertype=="National user") {
            $query = MgfComponent::find();
        }else if($usertype=="Applicant") {
            $userid=Yii::$app->user->identity->id;
            $query = MgfComponent::find()->where(['createdby'=>$userid]);
        }else{
            $query = MgfComponent::find()->joinWith('proposal');
        }
        
        //$query = MgfComponent::find();

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
            'component_no' => $this->component_no,
            'component_name' => $this->component_name,
            'proposal_id' => $this->proposal_id,
            'date_created' => $this->date_created,
            'activities'=>$this->activities,
            'createdby' => $this->createdby,
        ]);

        return $dataProvider;
    }
}
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
