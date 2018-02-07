<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mlu_course".
 *
 * @property integer $id
 * @property integer $course_id
 * @property string $name
 * @property integer $enroll_id
 *
 * @property MluUserEnrollee[] $mluUserEnrollees
 */
class MluCourse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlu_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'name', 'enroll_id'], 'required'],
            [['course_id', 'enroll_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['course_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'Course ID',
            'name' => 'Training Attended',
            'enroll_id' => 'Enroll ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMluUserEnrollees()
    {
        return $this->hasMany(MluUserEnrollee::className(), ['course_id' => 'course_id']);
    }
}
