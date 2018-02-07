<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MluManualAssessment;

/**
 * MluManualAssessmentSearch represents the model behind the search form about `backend\models\MluManualAssessment`.
 */
class MluManualAssessmentSearch extends MluManualAssessment
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
            'training_id' => $this->training_id,
            'id_number' => $this->id_number,
        ]);*/
        $query->joinWith('training');

        $query->orFilterWhere(['like', 'mlu_manual_assessment.fname', $this->globalSearch])
              ->orFilterWhere(['like', 'mlu_manual_assessment.lname', $this->globalSearch])
              ->orFilterWhere(['like', 'mlu_manual_assessment.id_number', $this->globalSearch])
              ->orFilterWhere(['like', 'mlu_manual_assessment.region', $this->globalSearch])
              ->orFilterWhere(['like', 'mlu_manual_assessment.area', $this->globalSearch])
              ->orFilterWhere(['like', 'mlu_manual_training.name', $this->globalSearch]);

        return $dataProvider;
    }
}
