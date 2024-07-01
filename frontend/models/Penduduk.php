<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "penduduk".

 * @property Provinsi $provinsi
 * @property KabKota $kabKota
 * 
 * 
 */

class Penduduk extends \jeemce\models\Model
{
    use PendudukTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penduduk';
    }

    public function rules()
    {
        return [
            [['nama', 'nik', 'alamat'], 'string'],
            [['nama', 'nik', 'gender', 'tanggal_lahir', 'alamat', 'province_id', 'regency_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nama' => 'Nama',
            'nik' => 'NIK',
            'alamat' => 'Alamat',
            'umur' => 'Umur',
            'regency_id' => 'Kabupaten / Kota',
            'province_id' => 'Provinsi'
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

    public function getUmur()
    {
        $umur = Yii::$app->db->createCommand(
            <<<SQL
            SELECT TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) 
            AS umur FROM penduduk WHERE id = :id
            SQL
        )->bindValue(':id', $this->id)
            ->queryScalar();

        return $umur;
    }
}
