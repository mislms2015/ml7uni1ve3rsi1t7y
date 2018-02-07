<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mlu_role_assignment".
 *
 * @property integer $id
 * @property integer $assign_id
 * @property integer $region_id
 *
 * @property MluRegion $region
 * @property MluRoleUser $assign
 */
class MluRoleAssignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlu_role_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['assign_id', 'region_id'], 'required'],
            [['assign_id', 'region_id'], 'integer'],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => MluRegion::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['assign_id'], 'exist', 'skipOnError' => true, 'targetClass' => MluRoleUser::className(), 'targetAttribute' => ['assign_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'assign_id' => 'Assign ID',
            'region_id' => 'Region ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(MluRegion::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssign()
    {
        return $this->hasOne(MluRoleUser::className(), ['id' => 'assign_id']);
    }
}
