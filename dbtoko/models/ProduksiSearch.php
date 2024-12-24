<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Produksi;

/**
 * ProduksiSearch represents the model behind the search form of `app\models\Produksi`.
 */
class ProduksiSearch extends Produksi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_produksi', 'id_bahan'], 'integer'],
            [['status', 'tanggal_produksi'], 'safe'],
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
        $query = Produksi::find();

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
            'id_produksi' => $this->id_produksi,
            'tanggal_produksi' => $this->tanggal_produksi,
            'id_bahan' => $this->id_bahan,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
