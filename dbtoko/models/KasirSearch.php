<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kasir;

/**
 * KasirSearch represents the model behind the search form of `app\models\Kasir`.
 */
class KasirSearch extends Kasir
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kasir', 'total_harga', 'id_produksi', 'id_transaksi'], 'integer'],
            [['jumlah'], 'safe'],
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
        $query = Kasir::find();

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
            'id_kasir' => $this->id_kasir,
            'total_harga' => $this->total_harga,
            'id_produksi' => $this->id_produksi,
            'id_transaksi' => $this->id_transaksi,
        ]);

        $query->andFilterWhere(['like', 'jumlah', $this->jumlah]);

        return $dataProvider;
    }
}
