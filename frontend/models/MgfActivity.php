<?php

namespace frontend\models;
use backend\models\User;
use Yii;

/**
 * This is the model class for table "mgf_activity".
 *
 * @property int $id
 * @property int $activity_no
 * @property string $activity_name
 * @property float $subtotal
 * @property int $componet_id
 * @property string $date_created
 * @property int $createdby
 * @property int $inputs
 *
 * @property Users $createdby0
 * @property MgfComponent $componet
 * @property MgfInputCost[] $mgfInputCosts
 * @property MgfInputItem[] $mgfInputItems
 */
class MgfActivity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_no', 'activity_name', 'componet_id', 'createdby'], 'required'],
            [['activity_no', 'componet_id', 'createdby','inputs'], 'integer'],
            [['activity_name'], 'string'],
            [['subtotal'], 'number'],
            [['date_created','inputs'], 'safe'],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
            [['componet_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfComponent::className(), 'targetAttribute' => ['componet_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_no' => 'Activity No',
            'activity_name' => 'Activity',
            'subtotal' => 'Activity Cost',
            'componet_id' => 'Componet',
            'inputs' => 'Inputs Added',
            'date_created' => 'Date Created',
            'createdby' => 'Createdby',
        ];
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
     * Gets query for [[Componet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComponet()
    {
        return $this->hasOne(MgfComponent::className(), ['id' => 'componet_id']);
    }

    /**
     * Gets query for [[MgfInputCosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfInputCosts()
    {
        return $this->hasMany(MgfInputCost::className(), ['activity_id' => 'id']);
    }

    /**
     * Gets query for [[MgfInputItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfInputItems(){
        return $this->hasMany(MgfInputItem::className(), ['activity_id' => 'id']);
    }
}
