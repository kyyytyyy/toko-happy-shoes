<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BahanDasar;

/**
 * BahanDasarSearch represents the model behind the search form of `app\models\BahanDasar`.
 */
class BahanDasarSearch extends BahanDasar
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_bahan', 'jumlah_bahan', 'id_supplier'], 'integer'],
            [['nama_bahan'], 'safe'],
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
        $query = BahanDasar::find();

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
            'id_bahan' => $this->id_bahan,
            'jumlah_bahan' => $this->jumlah_bahan,
            'id_supplier' => $this->id_supplier,
        ]);

        $query->andFilterWhere(['like', 'nama_bahan', $this->nama_bahan]);

        return $dataProvider;
    }
}
