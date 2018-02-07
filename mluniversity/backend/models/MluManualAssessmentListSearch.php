<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MluManualAssessment;

/**
 * MluManualAssessmentSearch represents the model behind the search form about `backend\models\MluManualAssessment`.
 */
class MluManualAssessmentListSearch extends MluManualAssessment
{
    /**
     * @inheritdoc
     */
    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'training_id', 'id_number'], 'integer'],
            [['fname', 'lname', 'globalSearch'], 'safe'],
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
        $query = MluManualAssessment::find();
        /*$query = Applicant::find()
               ->alias('s')
               ->asArray()
               ->joinWith('course as t')
               ->where(['t.course_year' => '4 years']);*/
               //->orderBy('s.id');

        // add conditions that should always apply here

        /*$dataProvider = new ActiveDataProvider([
              'query' => Applicant::find()
                      ->alias('s')
                      ->asArray()
                      ->joinWith('course as t')
                      ->where(['t.course_year' => '4 years'])
                      ->orderBy('s.id'),
            ]);*/
          $dataProvider = new ActiveDataProvider([
                'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
//SELECT * FROM `applicant` AS a JOIN `course` AS c WHERE a.course_id = c.id AND c.course_year = '4 years'
        //$query->joinWith('course');

        $query->orFilterWhere(['like', 'fname', $this->globalSearch])
              ->orFilterWhere(['like', 'lname', $this->globalSearch])
              ->orderBy('id');

        return $dataProvider;
    }
}
