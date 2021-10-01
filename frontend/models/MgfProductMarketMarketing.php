<?php

namespace frontend\models;
use backend\models\User;
use frontend\models\MgfProposal;
use frontend\models\MgfApplicant;

use Yii;

/**
 * This is the model class for table "mgf_product_market_marketing".
 *
 * @property int $id
 * @property string $marketing
 * @property string|null $market_outlets
 * @property string|null $sales_contract
 * @property string|null $person_responsible
 * @property string|null $competition_penetration
 * @property string|null $future_prospects
 * @property string|null $branding_market_penetration
 * @property int $proposal_id
 * @property string $date_created
 * @property string $date_update
 * @property int $created_by
 * @property int|null $updated_by
 *
 * @property Users $createdBy
 * @property MgfProposal $proposal
 */
class MgfProductMarketMarketing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_product_market_marketing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marketing', 'proposal_id', 'created_by'], 'required'],
            [['proposal_id', 'created_by', 'updated_by'], 'integer'],
            [['date_created', 'date_update'], 'safe'],
            [['marketing'], 'string', 'max' => 200],
            [['market_outlets', 'sales_contract', 'competition_penetration', 'future_prospects', 'branding_market_penetration'], 'string', 'max' => 100],
            [['person_responsible'], 'string', 'max' => 50],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
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
            'marketing' => 'Marketing',
            'market_outlets' => 'Market Outlets',
            'sales_contract' => 'Sales Contract',
            'person_responsible' => 'Person Responsible',
            'competition_penetration' => 'Competition Penetration',
            'future_prospects' => 'Future Prospects',
            'branding_market_penetration' => 'Branding Market Penetration',
           'proposal_id' => 'Proposal ID',
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
     * Gets query for [[Proposal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProposal()
    {
        return $this->hasOne(MgfProposal::className(), ['id' => 'proposal_id']);
    }
}
