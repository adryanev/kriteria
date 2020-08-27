<?php

namespace common\models\kriteria9\lk\prodi;

use common\helpers\kriteria9\K9ProdiProgressHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_lk_prodi_kriteria5".
 *
 * @property int $id
 * @property int $id_lk_prodi_kriteria5
 * @property double $progress
 * @property string $_5_a
 * @property string $_5_b
 * @property string $_5_c
 * @property int $created_at
 * @property int $updated_at
 *
 * @property K9LkProdiKriteria5 $lkProdiKriteria5
 *
 */
class K9LkProdiKriteria5Narasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_lk_prodi_kriteria5_narasi';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lk_prodi_kriteria5', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'number'],
            [['_5_a', '_5_b', '_5_c'], 'string'],
            [['id_lk_prodi_kriteria5'], 'exist', 'skipOnError' => true, 'targetClass' => K9LkProdiKriteria5::className(), 'targetAttribute' => ['id_lk_prodi_kriteria5' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_lk_prodi_kriteria5' => 'Id Lk Prodi',
            '_5_a' => '5 A',
            '_5_b' => '5 B',
            '_5_c' => '5 C',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLkProdiKriteria5()
    {
        return $this->hasOne(K9LkProdiKriteria5::className(), ['id' => 'id_lk_prodi_kriteria5']);
    }

    public function updateProgress()
    {
//        $dokumen = K9ProdiProgressHelper::getDokumenLkProgress($this->id_lk_prodi_kriteria5, $this->getK9LkProdiKriteria5Details(), 5);
//
//        $progress = round(($dokumen) / 1, 2);
//        $this->progress = $progress;
//        $this->save(false);
    }


}