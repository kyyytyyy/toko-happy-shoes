<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaksi".
 *
 * @property int $id_transaksi
 * @property string|null $tanggal_transaksi
 * @property int|null $id_pelanggan
 *
 * @property Kasir[] $kasirs
 * @property Pelanggan $pelanggan
 */
class Transaksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaksi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_transaksi'], 'required'],
            [['id_transaksi', 'id_pelanggan'], 'integer'],
            [['tanggal_transaksi'], 'safe'],
            [['id_transaksi'], 'unique'],
            [['id_pelanggan'], 'exist', 'skipOnError' => true, 'targetClass' => Pelanggan::class, 'targetAttribute' => ['id_pelanggan' => 'id_pelanggan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_transaksi' => 'Id Transaksi',
            'tanggal_transaksi' => 'Tanggal Transaksi',
            'id_pelanggan' => 'Id Pelanggan',
        ];
    }

    /**
     * Gets query for [[Kasirs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKasirs()
    {
        return $this->hasMany(Kasir::class, ['id_transaksi' => 'id_transaksi']);
    }

    /**
     * Gets query for [[Pelanggan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPelanggan()
    {
        return $this->hasOne(Pelanggan::class, ['id_pelanggan' => 'id_pelanggan']);
    }
}
