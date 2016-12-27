<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Driver;

/**
 * DriverSearch represents the model behind the search form about `app\models\Driver`.
 */
class DriverSearch extends Driver
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'city', 'cartime', 'starttime', 'addtime'], 'integer'],
            [['plates', 'owner', 'driver', 'licenseimg'], 'safe'],
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
        $query = Driver::find();

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
            'userid' => $this->userid,
            'city' => $this->city,
            'cartime' => $this->cartime,
            'starttime' => $this->starttime,
            'addtime' => $this->addtime,
        ]);

        $query->andFilterWhere(['like', 'plates', $this->plates])
            ->andFilterWhere(['like', 'owner', $this->owner])
            ->andFilterWhere(['like', 'driver', $this->driver])
            ->andFilterWhere(['like', 'licenseimg', $this->licenseimg]);

        return $dataProvider;
    }
}
