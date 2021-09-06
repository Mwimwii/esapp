<?php

namespace backend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "mgf_component".
 *
 * @property int $id
 * @property int $component_no
 * @property string $component_name
 * @property float $subtotal
 * @property int $proposal_id
 * @property int $activities
 * @property string $date_created
 * @property int $createdby
 *
 * @property MgfActivity[] $mgfActivities
 * @property Users $createdby0
 * @property MgfProposal $proposal
 */
class MgfComponent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_component';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['component_no', 'component_name', 'proposal_id', 'createdby'], 'required'],
            [['component_no', 'proposal_id', 'createdby','activities'], 'integer'],
            [['component_name'], 'string'],
            [['subtotal'], 'number'],
            [['date_created','activities'], 'safe'],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
            [['proposal_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfProposal::className(), 'targetAttribute' => ['proposal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'component_no' => 'Component No',
            'component_name' => 'Component',
            'subtotal' => 'Cost(ZMK)',
            'proposal_id' => 'Proposal',
            'date_created' => 'Date Created',
            'activities' => 'Activities Added',
            'createdby' => 'Createdby',
        ];
    }

    /**
     * Gets query for [[MgfActivities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfActivities()
    {
        return $this->hasMany(MgfActivity::className(), ['componet_id' => 'id']);
    }

    /**
     * Gets query for [[Createdby0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedby0()
    {
        return $this->hasOne(User::className(), ['id' => 'createdby']);
    }

    /**
     * Gets query for [[Proposal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProposal()
    {
        return $this->hasOne(MgfProposal::className(), ['id' => 'proposal_id']);
    }
}
