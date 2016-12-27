<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Route;

/**
 * RouteSearch represents the model behind the search form about `app\models\Route`.
 */
class RouteSearch extends Route
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'price', 'bprice5', 'bprice7', 'bprice9'], 'integer'],
            [['saddr', 'saddrname', 'slat', 'slng', 'eaddr', 'eaddrname', 'elng', 'elat'], 'safe'],
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
        $query = Route::find();

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
            'price' => $this->price,
            'bprice5' => $this->bprice5,
            'bprice7' => $this->bprice7,
            'bprice9' => $this->bprice9,
        ]);

        $query->andFilterWhere(['like', 'saddr', $this->saddr])
            ->andFilterWhere(['like', 'saddrname', $this->saddrname])
            ->andFilterWhere(['like', 'slat', $this->slat])
            ->andFilterWhere(['like', 'slng', $this->slng])
            ->andFilterWhere(['like', 'eaddr', $this->eaddr])
            ->andFilterWhere(['like', 'eaddrname', $this->eaddrname])
            ->andFilterWhere(['like', 'elng', $this->elng])
            ->andFilterWhere(['like', 'elat', $this->elat]);

        return $dataProvider;
    }
}
