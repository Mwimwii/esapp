<<<<<<< HEAD
<?php

namespace frontend\models;
use common\models\User;

use Yii;

/**
 * This is the model class for table "mgf_selection_category".
 *
 * @property int $id
 * @property string $category
 * @property string $date_created
 * @property int $createdby
 *
 * @property Users $createdby0
 * @property MgfSelectionCriteria[] $mgfSelectionCriterias
 */
class MgfSelectionCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_selection_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'createdby'], 'required'],
            [['category'], 'string'],
            [['date_created'], 'safe'],
            [['createdby'], 'integer'],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
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
     * Gets query for [[MgfSelectionCriterias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfSelectionCriterias()
    {
        return $this->hasMany(MgfSelectionCriteria::className(), ['category_id' => 'id']);
    }
}
=======
<?php

namespace backend\models;
use common\models\User;

use Yii;

/**
 * This is the model class for table "mgf_selection_category".
 *
 * @property int $id
 * @property string $category
 * @property string $date_created
 * @property int $createdby
 *
 * @property Users $createdby0
 * @property MgfSelectionCriteria[] $mgfSelectionCriterias
 */
class MgfSelectionCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mgf_selection_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'createdby'], 'required'],
            [['category'], 'string'],
            [['date_created'], 'safe'],
            [['createdby'], 'integer'],
            [['createdby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdby' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
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
     * Gets query for [[MgfSelectionCriterias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMgfSelectionCriterias()
    {
        return $this->hasMany(MgfSelectionCriteria::className(), ['category_id' => 'id']);
    }
}
>>>>>>> 87e1ba7543e0dfcf71922c993956787e66ff639d
