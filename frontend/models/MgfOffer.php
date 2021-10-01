<<<<<<< HEAD
<?php

namespace frontend\models;
use common\models\User;

use Yii;

/**
 * This is the model class for table "mgf_offer".
 *
 * @property int $id
 * @property int $proposal_id
 * @property int $organisation_id
 * @property string|null $status
 * @property float $amountoffered
 * @property float $contribution
 * @property int|null $responded
 * @property string $date_created
 * @property string|null $date_responde
 * @property int $createdby
 *
 * @property Users $createdby0
 * @property MgfProposal $proposal
 * @property MgfOrganisation $organisation
 */
class MgfOffer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_offer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proposal_id', 'organisation_id', 'amountoffered', 'contribution', 'createdby'], 'required'],
            [['proposal_id', 'organisation_id', 'responded', 'createdby'], 'integer'],
            [['status'], 'string'],
            [['amountoffered', 'contribution'], 'number'],
            [['date_created', 'date_responde'], 'safe'],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
            [['proposal_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfProposal::className(), 'targetAttribute' => ['proposal_id' => 'id']],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfOrganisation::className(), 'targetAttribute' => ['organisation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'proposal_id' => 'Proposal ID',
            'organisation_id' => 'Organisation ID',
            'status' => 'Status',
            'amountoffered' => 'Amountoffered',
            'contribution' => 'Contribution',
            'responded' => 'Responded',
            'date_created' => 'Date Created',
            'date_responde' => 'Date Responde',
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
     * Gets query for [[Proposal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProposal()
    {
        return $this->hasOne(MgfProposal::className(), ['id' => 'proposal_id']);
    }

    /**
     * Gets query for [[Organisation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(MgfOrganisation::className(), ['id' => 'organisation_id']);
    }
}
=======
<?php

namespace backend\models;
use common\models\User;

use Yii;

/**
 * This is the model class for table "mgf_offer".
 *
 * @property int $id
 * @property int $proposal_id
 * @property int $organisation_id
 * @property string|null $status
 * @property float $amountoffered
 * @property float $contribution
 * @property int|null $responded
 * @property string $date_created
 * @property string|null $date_responde
 * @property int $createdby
 *
 * @property Users $createdby0
 * @property MgfProposal $proposal
 * @property MgfOrganisation $organisation
 */
class MgfOffer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_offer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proposal_id', 'organisation_id', 'amountoffered', 'contribution', 'createdby'], 'required'],
            [['proposal_id', 'organisation_id', 'responded', 'createdby'], 'integer'],
            [['status'], 'string'],
            [['amountoffered', 'contribution'], 'number'],
            [['date_created', 'date_responde'], 'safe'],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
            [['proposal_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfProposal::className(), 'targetAttribute' => ['proposal_id' => 'id']],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfOrganisation::className(), 'targetAttribute' => ['organisation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'proposal_id' => 'Proposal ID',
            'organisation_id' => 'Organisation ID',
            'status' => 'Status',
            'amountoffered' => 'Amountoffered',
            'contribution' => 'Contribution',
            'responded' => 'Responded',
            'date_created' => 'Date Created',
            'date_responde' => 'Date Responde',
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
     * Gets query for [[Proposal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProposal()
    {
        return $this->hasOne(MgfProposal::className(), ['id' => 'proposal_id']);
    }

    /**
     * Gets query for [[Organisation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(MgfOrganisation::className(), ['id' => 'organisation_id']);
    }
}
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
