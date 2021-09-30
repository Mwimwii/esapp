<<<<<<< HEAD
<?php

namespace frontend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "mgf_proposal_evaluation".
 *
 * @property int $id
 * @property int $proposal_id
 * @property int $criterion_id
 * @property int|null $awardedscore
 * @property string|null $grade
 * @property string|null $comment
 * @property string $date_created
 * @property int $createdby
 *
 * @property Users $createdby0
 * @property MgfProposal $proposal
 * @property MgfSelectionCriteria $criterion
 */
class MgfProposalEvaluation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_proposal_evaluation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proposal_id', 'criterion_id', 'createdby'], 'required'],
            [['proposal_id', 'criterion_id', 'awardedscore', 'createdby'], 'integer'],
            [['comment'], 'string'],
            [['date_created'], 'safe'],
            [['grade'], 'string', 'max' => 70],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
            [['proposal_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfProposal::className(), 'targetAttribute' => ['proposal_id' => 'id']],
            [['criterion_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfSelectionCriteria::className(), 'targetAttribute' => ['criterion_id' => 'id']],
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
            'criterion_id' => 'Criterion ID',
            'awardedscore' => 'Awardedscore',
            'grade' => 'Grade',
            'comment' => 'Comment',
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
     * Gets query for [[Proposal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProposal()
    {
        return $this->hasOne(MgfProposal::className(), ['id' => 'proposal_id']);
    }

    /**
     * Gets query for [[Criterion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCriterion()
    {
        return $this->hasOne(MgfSelectionCriteria::className(), ['id' => 'criterion_id']);
    }
}
=======
<?php

namespace backend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "mgf_proposal_evaluation".
 *
 * @property int $id
 * @property int $proposal_id
 * @property int $criterion_id
 * @property int|null $awardedscore
 * @property string|null $grade
 * @property string|null $comment
 * @property string $date_created
 * @property int $createdby
 *
 * @property Users $createdby0
 * @property MgfProposal $proposal
 * @property MgfSelectionCriteria $criterion
 */
class MgfProposalEvaluation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_proposal_evaluation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proposal_id', 'criterion_id', 'createdby'], 'required'],
            [['proposal_id', 'criterion_id', 'awardedscore', 'createdby'], 'integer'],
            [['comment'], 'string'],
            [['date_created'], 'safe'],
            [['grade'], 'string', 'max' => 70],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
            [['proposal_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfProposal::className(), 'targetAttribute' => ['proposal_id' => 'id']],
            [['criterion_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfSelectionCriteria::className(), 'targetAttribute' => ['criterion_id' => 'id']],
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
            'criterion_id' => 'Criterion ID',
            'awardedscore' => 'Awardedscore',
            'grade' => 'Grade',
            'comment' => 'Comment',
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
     * Gets query for [[Proposal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProposal()
    {
        return $this->hasOne(MgfProposal::className(), ['id' => 'proposal_id']);
    }

    /**
     * Gets query for [[Criterion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCriterion()
    {
        return $this->hasOne(MgfSelectionCriteria::className(), ['id' => 'criterion_id']);
    }
}
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
