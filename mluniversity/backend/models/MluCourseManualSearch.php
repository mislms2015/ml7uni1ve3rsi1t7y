<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MluUserEnrollee;


/**
 * MluCourseSearch represents the model behind the search form about `backend\models\MluCourse`.
 */
class MluCourseManualSearch extends MluUserEnrollee
{
    /**
     * @inheritdoc
     */

    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'user_id', 'id_number', 'enrollment_id', 'course_id'], 'integer'],
            [['username', 'fname', 'lname', 'globalSearch'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = MluUserEnrollee::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        /*$query->andFilterWhere([
            'id' => $this->id,
            'course_id' => $this->course_id,
        ]);*/

        $query->joinWith('course');

        $query->orFilterWhere(['like', 'mlu_user_enrollee.id_number', $this->globalSearch])
              ->orFilterWhere(['like', 'mlu_user_enrollee.fname', $this->globalSearch])
              ->orFilterWhere(['like', 'mlu_user_enrollee.lname', $this->globalSearch])
              ->orFilterWhere(['like', 'mlu_course.name', $this->globalSearch]);

        return $dataProvider;
    }
}
