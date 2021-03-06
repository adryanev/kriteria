<?php

namespace common\models\kriteria9\led\institusi;

use common\helpers\kriteria9\K9InstitusiProgressHelper;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "k9_led_institusi_kriteria5".
 *
 * @property int $id
 * @property int $id_led_institusi
 * @property double $progress
 * @property int $created_at
 * @property int $updated_at
 *
 * @property K9LedInstitusi $ledInstitusi
 * @property K9LedInstitusiKriteria5Detail[] $k9LedInstitusiKriteria5Details
 * @property K9LedInstitusiNarasiKriteria5 $k9LedInstitusiNarasiKriteria5s
 */
class K9LedInstitusiKriteria5 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'k9_led_institusi_kriteria5';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_led_institusi', 'created_at', 'updated_at'], 'integer'],
            [['progress'], 'number'],
            [['id_led_institusi'], 'exist', 'skipOnError' => true, 'targetClass' => K9LedInstitusi::className(), 'targetAttribute' => ['id_led_institusi' => 'id']],
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_led_institusi' => 'Id Led Institusi',
            'progress' => 'Progress',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLedInstitusi()
    {
        return $this->hasOne(K9LedInstitusi::className(), ['id' => 'id_led_institusi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedInstitusiKriteria5Details()
    {
        return $this->hasMany(K9LedInstitusiKriteria5Detail::className(), ['id_led_institusi_kriteria5' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getK9LedInstitusiNarasiKriteria5s()
    {
        return $this->hasOne(K9LedInstitusiNarasiKriteria5::className(), ['id_led_institusi_kriteria5' => 'id']);
    }

    public function updateProgress()
    {
        $narasi = $this->k9LedInstitusiNarasiKriteria5s->progress;

        $dokumen = K9InstitusiProgressHelper::getDokumenLedProgress($this->id_led_institusi,$this->getK9LedInstitusiKriteria5Details(), 5);

        $progress = round(($narasi+$dokumen)/2,2);
        $this->progress = $progress;
        $this->save(false);
    }
}
