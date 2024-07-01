<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reg_provinces".
 * @property char $id
 * @property varchar $name
 */

class Provinsi extends \jeemce\models\Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reg_provinces';
    }

    public function rules()
    {
        return [
            [['name'], 'string'],
            [['name'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nama',
            'totalPenduduk' => 'Banyak Penduduk'
        ];
    }

    public function getTotalPenduduk()
    {
        $totalPenduduk = Yii::$app->db->createCommand(
            <<<SQL
                SELECT COUNT(*) AS total_villages 
                FROM penduduk 
                WHERE province_id = :province_id
            SQL
        )->bindValue(':province_id', $this->id)
            ->queryScalar() ?: 0;

        return $totalPenduduk;
    }
}
