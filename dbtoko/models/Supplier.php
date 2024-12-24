<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id_supplier
 * @property string|null $nama
 * @property string|null $kontak
 *
 * @property BahanDasar[] $bahanDasars
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'string', 'max' => 50],
            [['kontak'], 'string', 'max' => 13],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_supplier' => 'Id Supplier',
            'nama' => 'Nama',
            'kontak' => 'Kontak',
        ];
    }

    /**
     * Gets query for [[BahanDasars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBahanDasars()
    {
        return $this->hasMany(BahanDasar::class, ['id_supplier' => 'id_supplier']);
    }
}
