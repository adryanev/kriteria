<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */

/**
 * Class K9DetailLedInstitusiLinkForm
 * @package akreditasi\models\kriteria9\forms\led
 */


namespace akreditasi\models\kriteria9\forms\led;


use common\helpers\FileTypeHelper;
use common\models\kriteria9\led\institusi\K9LedInstitusiNonKriteriaDokumen;
use yii\base\Model;

class K9DetailLedInstitusiNonKriteriaTeksForm extends Model
{

    public $kode_dokumen;
    public $nama_dokumen;
    public $berkasDokumen;
    public $jenis_dokumen;

    private $_detailLedInstitusi;

    public function rules()
    {
        return [
            [['kode_dokumen', 'nama_dokumen', 'berkasDokumen', 'jenis_dokumen'], 'required'],
            [['kode_dokumen', 'nama_dokumen', 'berkasDokumen', 'jenis_dokumen'], 'string'],
        ];
    }

    public function save($led)
    {

        if (!$this->validate()) {
            return false;
        }
        $this->_detailLedInstitusi = new K9LedInstitusiNonKriteriaDokumen();

        $this->_detailLedInstitusi->id_led_institusi = $led;
        $this->_detailLedInstitusi->kode_dokumen = $this->kode_dokumen;
        $this->_detailLedInstitusi->nama_dokumen = $this->nama_dokumen;
        $this->_detailLedInstitusi->isi_dokumen = $this->berkasDokumen;
        $this->_detailLedInstitusi->jenis_dokumen = $this->jenis_dokumen;
        $this->_detailLedInstitusi->bentuk_dokumen = FileTypeHelper::TYPE_STATIC_TEXT;

        $this->_detailLedInstitusi->save(false);

        return $this->_detailLedInstitusi;

    }

}