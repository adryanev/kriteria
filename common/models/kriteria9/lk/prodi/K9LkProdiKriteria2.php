<?php

namespace common\models\kriteria9\lk\prodi;

use common\helpers\kriteria9\K9ProdiProgressHelper;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_lk_prodi_kriteria2".
 *
 * @property int $id
 * @property int|null $id_lk_prodi
 * @property float|null $progress_narasi
 * @property float|null $progress_dokumen
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property K9LkProdi $lkProdi
 * @property K9LkProdiKriteria2Narasi $k9LkProdiKriteria2Narasi
 * @property K9LkProdiKriteria2Detail[] $k9LkProdiKriteria2Details
 * @property float $progress
 */
class K9LkProdiKriteria2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_lk_prodi_kriteria2';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lk_prodi', 'created_at', 'updated_at'], 'integer'],
            [['progress_narasi', 'progress_dokumen'], 'number'],
            [['id_lk_prodi'], 'exist', 'skipOnError' => true, 'targetClass' => K9LkProdi::className(), 'targetAttribute' => ['id_lk_prodi' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_lk_prodi' => 'Id Lk Prodi',
            'progress_narasi' => 'Progress Narasi',
            'progress_dokumen' => 'Progress Dokumen',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[LkProdi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLkProdi()
    {
        return $this->hasOne(K9LkProdi::className(), ['id' => 'id_lk_prodi']);
    }

    /**
     * Gets query for [[K9LkProdiKriteria2Narasi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getK9LkProdiKriteria2Narasi()
    {
        return $this->hasOne(K9LkProdiKriteria2Narasi::className(), ['id_lk_prodi_kriteria2' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LkProdiKriteria2Details()
    {
        return $this->hasMany(K9LkProdiKriteria2Detail::className(), ['id_lk_prodi_kriteria2' => 'id']);
    }

    public function getProgress(){
        return round(( $this->progress_narasi + $this->progress_dokumen)/2,2);
    }

     public function updateProgressNarasi(){

        $this->progress_narasi = $this->k9LkProdiKriteria2Narasi->progress;
        return $this;
    }
    public function updateProgressDokumen()
    {
        $dokumen = K9ProdiProgressHelper::getDokumenLkProgress($this, $this->getK9LkProdiKriteria2Details(), 2);
        $progress = round($dokumen, 2);
        $this->progress_dokumen = $progress;
        return $this;
    }
}
