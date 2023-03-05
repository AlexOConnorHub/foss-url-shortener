<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Shortened;

/**
 * ShortenedSearch represents the model behind the search form of `app\models\Shortened`.
 */
class ShortenedSearch extends Shortened {
    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'user_id'], 'integer'],
            [['edit_uuid', 'redirect_uuid', 'redirect_url'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Shortened::find();

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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'edit_uuid', $this->edit_uuid])
            ->andFilterWhere(['like', 'redirect_uuid', $this->redirect_uuid])
            ->andFilterWhere(['like', 'redirect_url', $this->redirect_url]);

        return $dataProvider;
    }
}
