<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mlu_sub_course".
 *
 * @property integer $id
 * @property integer $course_id
 * @property string $name
 */
class MluSubCourse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mlu_sub_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'name'], 'required'],
            [['course_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
        ];
    }
}
