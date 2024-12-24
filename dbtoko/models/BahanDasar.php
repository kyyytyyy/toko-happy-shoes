<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bahan_dasar".
 *
 * @property int $id_bahan
 * @property string|null $nama_bahan
 * @property int|null $jumlah_bahan
 * @property int|null $id_supplier
 *
 * @property Produksi[] $produksis
 * @property Supplier $supplier
 */
class BahanDasar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bahan_dasar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_bahan'], 'required'],
            [['id_bahan', 'jumlah_bahan', 'id_supplier'], 'integer'],
            [['nama_bahan'], 'string', 'max' => 50],
            [['id_bahan'], 'unique'],
            [['id_supplier'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::class, 'targetAttribute' => ['id_supplier' => 'id_supplier']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_bahan' => 'Id Bahan',
            'nama_bahan' => 'Nama Bahan',
            'jumlah_bahan' => 'Jumlah Bahan',
            'id_supplier' => 'Id Supplier',
        ];
    }

    /**
     * Gets query for [[Produksis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduksis()
    {
        return $this->hasMany(Produksi::class, ['id_bahan' => 'id_bahan']);
    }

    /**
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, ['id_supplier' => 'id_supplier']);
    }
}
