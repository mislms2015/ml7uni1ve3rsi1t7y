<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mlu_role_user".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $role_id
 *
 * @property MluRoleAssignment[] $mluRoleAssignments
 * @property MluRole $role
 * @property User $user
 */
class MluRoleUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlu_role_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id'], 'required'],
            [['user_id', 'role_id'], 'integer'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => MluRole::className(), 'targetAttribute' => ['role_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'role_id' => 'Role ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMluRoleAssignments()
    {
        return $this->hasMany(MluRoleAssignment::className(), ['assign_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(MluRole::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
