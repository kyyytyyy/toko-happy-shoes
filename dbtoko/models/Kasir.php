<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kasir".
 *
 * @property int $id_kasir
 * @property string|null $jumlah
 * @property int|null $total_harga
 * @property int|null $id_produksi
 * @property int|null $id_transaksi
 *
 * @property Produksi $produksi
 * @property Transaksi $transaksi
 */
class Kasir extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kasir';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kasir'], 'required'],
            [['id_kasir', 'total_harga', 'id_produksi', 'id_transaksi'], 'integer'],
            [['jumlah'], 'string', 'max' => 30],
            [['id_kasir'], 'unique'],
            [['id_produksi'], 'exist', 'skipOnError' => true, 'targetClass' => Produksi::class, 'targetAttribute' => ['id_produksi' => 'id_produksi']],
            [['id_transaksi'], 'exist', 'skipOnError' => true, 'targetClass' => Transaksi::class, 'targetAttribute' => ['id_transaksi' => 'id_transaksi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kasir' => 'Id Kasir',
            'jumlah' => 'Jumlah',
            'total_harga' => 'Total Harga',
            'id_produksi' => 'Id Produksi',
            'id_transaksi' => 'Id Transaksi',
        ];
    }

    /**
     * Gets query for [[Produksi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduksi()
    {
        return $this->hasOne(Produksi::class, ['id_produksi' => 'id_produksi']);
    }

    /**
     * Gets query for [[Transaksi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksi()
    {
        return $this->hasOne(Transaksi::class, ['id_transaksi' => 'id_transaksi']);
    }
}
