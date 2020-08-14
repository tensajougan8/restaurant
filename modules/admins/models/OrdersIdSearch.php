<?php

namespace app\modules\admins\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admins\models\OrdersId;

/**
 * OrdersIdSearch represents the model behind the search form of `app\modules\admins\models\OrdersId`.
 */
class OrdersIdSearch extends OrdersId
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
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
        $query = OrdersId::find();

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
            'customer_id' => $this->customer_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
