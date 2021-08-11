<?php

namespace frontend\models;
use common\models\User;

use Yii;

/**
 * This is the model class for table "mgf_selection_grade".
 *
 * @property int $id
 * @property string $grade
 * @property int $criterion_id
 * @property int $awardedscore
 * @property string $date_created
 * @property int $createdby
 *
 * @property Users $createdby0
 * @property MgfSelectionCriteria $criterion
 */
class MgfSelectionGrade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_selection_grade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grade', 'criterion_id', 'awardedscore', 'createdby'], 'required'],
            [['criterion_id', 'awardedscore', 'createdby'], 'integer'],
            [['date_created'], 'safe'],
            [['grade'], 'string', 'max' => 20],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
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
            'grade' => 'Grade',
            'criterion_id' => 'Criterion ID',
            'awardedscore' => 'Awardedscore',
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
     * Gets query for [[Criterion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCriterion()
    {
        return $this->hasOne(MgfSelectionCriteria::className(), ['id' => 'criterion_id']);
    }
}
