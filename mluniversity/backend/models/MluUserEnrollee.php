<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mlu_user_enrollee".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $id_number
 * @property string $username
 * @property integer $enrollment_id
 * @property integer $course_id
 * @property string $fname
 * @property string $lname
 *
 * @property MluCourse $course
 */
class MluUserEnrollee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlu_user_enrollee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'id_number', 'username', 'enrollment_id', 'course_id', 'fname', 'lname'], 'required'],
            [['user_id', 'id_number', 'enrollment_id', 'course_id'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['fname', 'lname'], 'string', 'max' => 100],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => MluCourse::className(), 'targetAttribute' => ['course_id' => 'course_id']],
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
            'id_number' => 'ID Number',
            'username' => 'Username',
            'enrollment_id' => 'Enrollment ID',
            'course_id' => 'Course ID',
            'fname' => 'Firstname',
            'lname' => 'Lastname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(MluCourse::className(), ['course_id' => 'course_id']);
    }
}
