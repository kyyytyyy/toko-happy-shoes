<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "produksi".
 *
 * @property int $id_produksi
 * @property string|null $status
 * @property string|null $tanggal_produksi
 * @property int|null $id_bahan
 *
 * @property BahanDasar $bahan
 * @property Kasir[] $kasirs
 */
class Produksi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produksi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_produksi'], 'required'],
            [['id_produksi', 'id_bahan'], 'integer'],
            [['tanggal_produksi'], 'safe'],
            [['status'], 'string', 'max' => 45],
            [['id_produksi'], 'unique'],
            [['id_bahan'], 'exist', 'skipOnError' => true, 'targetClass' => BahanDasar::class, 'targetAttribute' => ['id_bahan' => 'id_bahan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_produksi' => 'Id Produksi',
            'status' => 'Status',
            'tanggal_produksi' => 'Tanggal Produksi',
            'id_bahan' => 'Id Bahan',
        ];
    }

    /**
     * Gets query for [[Bahan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBahan()
    {
        return $this->hasOne(BahanDasar::class, ['id_bahan' => 'id_bahan']);
    }

    /**
     * Gets query for [[Kasirs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKasirs()
    {
        return $this->hasMany(Kasir::class, ['id_produksi' => 'id_produksi']);
    }
}
