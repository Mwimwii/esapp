<?php

namespace frontend\models;
use backend\models\User;
use Yii;

/**
 * This is the model class for table "mgf_costs_financing_plan".
 *
 * @property int $id
 * @property int $componentid
 * @property int $activityid
 * @property int $item_no
 * @property string $input_name
 * @property float $total_Project_cost
 * @property float $Applicant_in_kind
 * @property float $Applicant_in_cash
 * @property float $total_contribution
 * @property float $mgf_grant
 * @property float|null $other_sources
 * @property float|null $total
 * @property float|null $mgf_as_percent
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 * @property Users $createdBy
 * @property MgfComponent $component
 * @property MgfActivity $activity
 */
class MgfCostsFinancingPlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_costs_financing_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['componentid', 'activityid','item_no', 'input_name', 'total_Project_cost', 'Applicant_in_kind', 'Applicant_in_cash', 'total_contribution', 'mgf_grant', 'created_by'], 'required'],
            [['componentid', 'activityid', 'item_no','created_by', 'updated_by'], 'integer'],
            [['total_Project_cost', 'Applicant_in_kind', 'Applicant_in_cash', 'total_contribution', 'mgf_grant', 'other_sources', 'total', 'mgf_as_percent'], 'number'],
            [['date_created', 'date_update'], 'safe'],
            [['input_name'], 'string', 'max' => 50],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['componentid'], 'exist', 'skipOnError' => true, 'targetClass' => MgfComponent::className(), 'targetAttribute' => ['componentid' => 'id']],
            [['activityid'], 'exist', 'skipOnError' => true, 'targetClass' => MgfActivity::className(), 'targetAttribute' => ['activityid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'componentid' => 'Componentid',
            'activityid' => 'Activityid',
            'item_no' => 'Item Number',
            'input_name' => 'Input Name',
            'total_Project_cost' => 'Total Project Cost',
            'Applicant_in_kind' => 'Applicant In Kind',
            'Applicant_in_cash' => 'Applicant In Cash',
            'total_contribution' => 'Total Contribution',
            'mgf_grant' => 'Mgf Grant',
            'other_sources' => 'Other Sources',
            'total' => 'Total',
            'mgf_as_percent' => 'Mgf As Percent',
            'date_created' => 'Date Created',
            'date_update' => 'Date Update',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * Gets query for [[Component]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComponent()
    {
        return $this->hasOne(MgfComponent::className(), ['id' => 'componentid']);
    }

    /**
     * Gets query for [[Activity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(MgfActivity::className(), ['id' => 'activityid']);
    }
}
