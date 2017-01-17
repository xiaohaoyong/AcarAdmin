<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * OrderSearch represents the model behind the search form about `app\models\Order`.
 */
class OrderSearch extends Order
{
    public $start;//开始时间

    public $end;//结束时间
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userid', 'driverid', 'addtime', 'routeid', 'status', 'type', 'num', 'phone', 'bespeaktime', 'paytype', 'paystatus', 'trmb', 'prmb', 'paytime'], 'integer'],
            [['orderid', 'saddr', 'saddrname', 'slat', 'slng', 'eaddr', 'eaddrname', 'elat', 'elng', 'payid'], 'safe'],
            [['start','end'], 'date', 'format'=>'php:Y-m-d'],
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
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
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
            'userid' => $this->userid,
            'driverid' => $this->driverid,
            'addtime' => $this->addtime,
            'routeid' => $this->routeid,
            'status' => $this->status,
            'type' => $this->type,
            'num' => $this->num,
            'phone' => $this->phone,
            'bespeaktime' => $this->bespeaktime,
            'paytype' => $this->paytype,
            'paystatus' => $this->paystatus,
            'trmb' => $this->trmb,
            'prmb' => $this->prmb,
            'paytime' => $this->paytime,
        ]);

        $query->andFilterWhere(['like', 'orderid', $this->orderid])
            ->andFilterWhere(['like', 'saddr', $this->saddr])
            ->andFilterWhere(['like', 'saddrname', $this->saddrname])
            ->andFilterWhere(['like', 'slat', $this->slat])
            ->andFilterWhere(['like', 'slng', $this->slng])
            ->andFilterWhere(['like', 'eaddr', $this->eaddr])
            ->andFilterWhere(['like', 'eaddrname', $this->eaddrname])
            ->andFilterWhere(['like', 'elat', $this->elat])
            ->andFilterWhere(['like', 'elng', $this->elng])
            ->andFilterWhere(['like', 'payid', $this->payid]);

        return $dataProvider;
    }
}
