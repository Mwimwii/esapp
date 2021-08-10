<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "right".
 *
 * @property int $id
 * @property string $right
 */
class Right extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'permissions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['right', 'definition'], 'string', 'max' => 255],
            [['active'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'right' => 'Right',
        ];
    }

    public static function getAllRights() {
        $query = self::find()->all();
        return $query;
    }

    public static function getRightList() {
        $rights = self::find()->orderBy(['name' => SORT_ASC])->all();
        $list = ArrayHelper::map($rights, 'right', 'right');
        return $list;
    }

    public static function getRightList1() {
        $rights = self::find()->orderBy(['right' => SORT_ASC])->all();
        $list = ArrayHelper::map($rights, 'id', 'right');
        return $list;
    }

    public static function seedRights() {
        //Please add rights to the end of the $rights array in below format
        //Right => Definition
        $rights = [
            "Commodity-Specific AWPB" => "Commodity-Specific AWPB",
            "View programmes" => "View programmes",
            "Manage AWPB activities" => "Manage AWPB activities",
            'Manage AWPB activities' => "",
            'View AWPB activities' => "",
            'Manage components' => "",
            'View components' => "",
            'Manage AWPB templates' => "",
            'View AWPB templates' => "",
            'View AWPB activity lines' => "",
            'Manage AWPB' => "Manage AWPB",
            'Manage PW AWPB' => "Manage PW AWPB",
            'Manage AWPB activity lines' => 'View AWPB activity lines',
            'Submit District AWPB' => "",
            'Approve AWPB - Provincial' => 'Approve AWPB - Provincial',
            'Submit programme-wide AWPB' => 'Submit programme-wide AWPB',
            'Manage province consolidated AWPB' => 'Manage province consolidated AWPB',
            'Manage programme-wide AWPB activity lines' => 'Manage programme-wide AWPB activity lines',
            'Approve AWPB - PCO' => 'Approve AWPB - PCO',
            'Manage AWPB funders' => 'Manage AWPB funders',
            'View AWPB funders' => 'View AWPB funders',
            'Setup AWPB' => 'Setup AWPB',
            'View AWPB', 'View AWPB',
            'Approve AWPB - Ministry' => 'Approve AWPB - Ministry',
            'Manage programme-wide AWPB' => 'Manage programme-wide AWPB',
            'View PW AWPB' => 'View PW AWPB',
            'Manage Users' => "",
            'View Users' => "",
            'Manage Roles' => "",
            'View Roles' => "",
            'View profile' => "",
            'View audit trail logs' => "",
            'Manage provinces' => "",
            'Manage districts' => "",
            'Manage camps' => "",
            'Remove provinces' => "",
            'Remove districts' => "",
            'Remove camps' => "",
            'Manage markets' => "",
            'Remove markets' => "",
            'Manage commodity configs' => "",
            'Remove commodity config' => "",
            'Collect commodity prices' => "",
            'View commodity prices' => "",
            'Remove commodity price' => "",
            'Manage interview guide template questions' => "",
            'View interview guide template' => "",
            'Remove interview guide template question' => "",
            'Manage story of change categories' => "",
            'Submit story of change' => "",
            'Review Story of change' => "",
            'View Story of change' => "",
            'Attach case study articles' => "",
            'Manage faabs groups' => "",
            'View faabs groups' => "",
            'Remove faabs groups' => "",
            'Manage category A farmers' => "",
            'View category A farmers' => "",
            'Remove category A farmers' => "",
            'Submit FaaBS training records' => "",
            'View FaaBS training records' => "",
            'Remove FaaBS training records' => "",
            'Submit back to office report' => "",
            'Review back to office report' => "",
            'View back to office report' => "",
            'Plan camp monthly activities' => "",
            'Remove planned camp monthly activities' => "",
            'View planned camp monthly activities' => "",
            'Manage FaaBS training topics' => "",
            'View FaaBS training topics' => "",
            'Remove FaaBS training topics' => "",
            'View facilitation of improved technologies/best practices report' => "",
            'View training attendance cumulative report' => "",
            'View physical tracking table report' => "View physical tracking table report",
            'View MGF module' => "",
            'View MGF Applicants' => "",
            'View MGF Organisations' => "",
            'View MGF Concept Note' => "",
            'View MGF Application' => "",
            'View MGF Approvals' => "",
            'View MGF Proposals' => "",
            'View MGF Evaluations' => "",
            'Remove cost centre' => "Remove cost centre",
            'Manage cost centre' => "Manage cost centre",
            'Request Funds' => "Request Funds",
            'Approve Funds Requisition' => "Approve Funds Requisition",
            'Disburse Funds' => "Disburse Funds",
            'Review Funds Request' => "Review Funds Request",
            'View Funds Utilisation' => "View Funds Utilisation",
            'Remove project outreach records' => "Remove project outreach records",
            'Submit project outreach records' => "Can submit project outreach quarterly records",
            'Add staff hourly rates' => "Add staff hourly rates",
            'View staff hourly rates' => "View staff hourly rates",
            'Review timesheets' => "Review timesheets",
            'Submit timesheets' => "Submit timesheets",
                //php yii crons/seed-rights - Run this command in the esapp folder on the command prompt 
        ];

        $count = 0;
        foreach ($rights as $right => $definition) {
            if (empty(Right::findOne(["right" => $right]))) {
                $model = new Right();
                $model->right = $right;
                $model->definition = $definition;
                $model->active = 1;
                if ($model->save()) {
                    $count++;
                }
            }
        }
        echo "Inserted $count rights into permissions table";
    }

}
