<<<<<<< HEAD
<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mgf_pastproject".
 *
 * @property int $id
 * @property string|null $project_name
 * @property int $years_assisted
 * @property float $amount_assisted
 * @property string $obligations_met
 * @property string $outcome_response
 * @property int $organisation_id
 * @property int $experience_id
 * @property string $date_created
 *
 * @property MgfOrganisation $organisation
 * @property MgfExperience $experience
 */
class MgfPastproject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_pastproject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['years_assisted', 'amount_assisted', 'obligations_met', 'outcome_response', 'organisation_id','project_name', 'experience_id'], 'required'],
            [['years_assisted', 'organisation_id', 'experience_id'], 'integer'],
            [['amount_assisted'], 'number'],
            [['obligations_met', 'outcome_response'], 'string'],
            [['date_created'], 'safe'],
            [['project_name'], 'string', 'max' => 50],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfOrganisation::className(), 'targetAttribute' => ['organisation_id' => 'id']],
            [['experience_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfExperience::className(), 'targetAttribute' => ['experience_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'project_name' => 'Project Name',
            'years_assisted' => 'Years Assisted',
            'amount_assisted' => 'Amount Assisted(ZMW)',
            'obligations_met' => 'Performance/Result',
            'outcome_response' => 'Indicate whether you meet your obligations. What were your experiences and lessons?',
            'organisation_id' => 'Organisation ',
            'experience_id' => 'Experience',
            'date_created' => 'Date Created',
        ];
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

    /**
     * Gets query for [[Experience]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperience()
    {
        return $this->hasOne(MgfExperience::className(), ['id' => 'experience_id']);
    }
}
=======
<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mgf_pastproject".
 *
 * @property int $id
 * @property string|null $project_name
 * @property int $years_assisted
 * @property float $amount_assisted
 * @property string $obligations_met
 * @property string $outcome_response
 * @property int $organisation_id
 * @property int $experience_id
 * @property string $date_created
 *
 * @property MgfOrganisation $organisation
 * @property MgfExperience $experience
 */
class MgfPastproject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_pastproject';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['years_assisted', 'amount_assisted', 'obligations_met', 'outcome_response', 'organisation_id','project_name', 'experience_id'], 'required'],
            [['years_assisted', 'organisation_id', 'experience_id'], 'integer'],
            [['amount_assisted'], 'number'],
            [['obligations_met', 'outcome_response'], 'string'],
            [['date_created'], 'safe'],
            [['project_name'], 'string', 'max' => 50],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfOrganisation::className(), 'targetAttribute' => ['organisation_id' => 'id']],
            [['experience_id'], 'exist', 'skipOnError' => true, 'targetClass' => MgfExperience::className(), 'targetAttribute' => ['experience_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'project_name' => 'Project Name',
            'years_assisted' => 'Years Assisted',
            'amount_assisted' => 'Amount Assisted(ZMW)',
            'obligations_met' => 'Performance/Result',
            'outcome_response' => 'Indicate whether you meet your obligations. What were your experiences and lessons?',
            'organisation_id' => 'Organisation ',
            'experience_id' => 'Experience',
            'date_created' => 'Date Created',
        ];
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

    /**
     * Gets query for [[Experience]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExperience()
    {
        return $this->hasOne(MgfExperience::className(), ['id' => 'experience_id']);
    }
}
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
