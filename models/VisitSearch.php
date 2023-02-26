<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Visit;

/**
 * VisitSearch represents the model behind the search form of `app\models\Visit`.
 */
class VisitSearch extends Visit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'shortened_id', 'user_id'], 'integer'],
            [['country_code', 'ip', 'user_agent', 'accepted_languages', 'created_at', 'isp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Visit::find();

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
        $query->andFilterWhere([
            'id' => $this->id,
            'shortened_id' => $this->shortened_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'country_code', $this->country_code])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'user_agent', $this->user_agent])
            ->andFilterWhere(['like', 'accepted_languages', $this->accepted_languages])
            ->andFilterWhere(['like', 'isp', $this->isp]);

        return $dataProvider;
    }
}
