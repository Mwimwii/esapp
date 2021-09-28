<?php

namespace frontend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "mgf_input_cost".
 *
 * @property int $id
 * @property int $item_no
 * @property string $input_name
 * @property float $unit_cost
 * @property float $project_year_1
 * @property float $project_year_2
 * @property float $project_year_3
 * @property float $project_year_4
 * @property float $project_year_5
 * @property float $project_year_6
 * @property float $project_year_7
 * @property float $project_year_8
 * @property float $total_cost
 * @property string $comment
 * @property int $activity_id
 * @property string $date_created
 * @property int $createdby
 *
 * @property Users $createdby0
 * @property MgfActivity $activity
 */
class MgfInputCost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_input_cost';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_no', 'input_name', 'unit_cost', 'total_cost', 'comment', 'activity_id', 'createdby'], 'required'],
            [['item_no', 'activity_id', 'createdby'], 'integer'],
            [['unit_cost', 'project_year_1', 'project_year_2', 'project_year_3', 'project_year_4','project_year_5', 'project_year_6', 'project_year_7', 'project_year_8','total_cost'], 'number'],
            [['comment','input_name'], 'string'],
            [['date_created'], 'safe'],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfActivity::className(), 'targetAttribute' => ['activity_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_no' => 'Item No',
            'input_name' => 'Input Name',
            'unit_cost' => 'Unit Cost',
            'project_year_1' => 'Project Year 1',
            'project_year_2' => 'Project Year 2',
            'project_year_3' => 'Project Year 3',
            'project_year_4' => 'Project Year 4',
            'project_year_5' => 'Project Year 5',
            'project_year_6' => 'Project Year 6',
            'project_year_7' => 'Project Year 7',
            'project_year_8' => 'Project Year 8',
            'total_cost' => 'Total Cost',
            'comment' => 'Comment',
            'activity_id' => 'Activity',
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
     * Gets query for [[Activity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(MgfActivity::className(), ['id' => 'activity_id']);
    }
}
