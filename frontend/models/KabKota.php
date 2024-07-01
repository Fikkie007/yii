<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reg_regencies".
 * @property char $id
 * @property char $province_id
 * @property varchar $name

 * @property Provinsi $provinsi
 * 
 */

class KabKota extends \jeemce\models\Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reg_regencies';
    }

    public function rules()
    {
        return [
            [['name', 'province_id'], 'string'],
            [['name', 'province_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nama',
            'provinsi.name' => 'Provinsi',
            'totalPenduduk' => 'Banyak Penduduk'
        ];
    }

    /**
     * Gets query for [[Provinsi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::class, ['id' => 'province_id']);
    }

    public function getTotalPenduduk()
    {
        $totalPenduduk = Yii::$app->db->createCommand(
            <<<SQL
                SELECT COUNT(*) AS total_villages 
                FROM penduduk
                WHERE regency_id = :regency_id
            SQL
        )->bindValue(':regency_id', $this->id)
            ->queryScalar() ?: 0;

        return $totalPenduduk;
    }
}
