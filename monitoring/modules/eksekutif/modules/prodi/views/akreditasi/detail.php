<?php
/**
 * @var $this yii\web\View
 * @var $modelProdi common\models\ProgramStudi
 * @var $akreditasiProdi common\models\kriteria9\akreditasi\K9AkreditasiProdi
 * @var $ledProdi common\models\kriteria9\led\prodi\K9LedProdi
 * @var $jsonLed array
 * @var $dokumenLed common\models\kriteria9\led\prodi\K9ProdiEksporDokumen
 * @var $kriteriaLed array
 * @var $urlLed string
 * @var $jsonLk array
 * @var $lkProdi common\models\kriteria9\lk\prodi\K9LkProdi
 * @var $kriteriaLk array
 */

use common\models\kriteria9\lk\Lk;
use common\models\ProgramStudi;
use yii\bootstrap4\Html;
use yii\bootstrap4\Progress;

$this->title = "Akreditasi: {$akreditasiProdi->akreditasi->nama} - {$modelProdi->nama}";
$this->params['breadcrumbs'][] = ['label' => 'Akreditasi Prodi', 'url' => ['index', 'prodi' => $_GET['prodi']]];
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>


<?= $this->render('@monitoring/views/common/_prodi_progress',
    ['prodi' => $modelProdi, 'model' => $akreditasiProdi, 'jenis' => ProgramStudi::PROGRAM_STUDI]) ?>

<div class="row">
    <div class="col-lg-12">

        <?= $this->render('@akreditasi/modules/kriteria9/modules/prodi/views/led/_dokumen_led', [
            'modelDokumen' => null,
            'dataDokumen' => $dokumenLed,
            'path' => $urlLed,
            'untuk' => 'lihat',
            'prodi' => $modelProdi
        ]) ?>

        <?= $this->render('@akreditasi/modules/kriteria9/modules/prodi/views/led/_tabel_led', [
            'kriteria' => $kriteriaLed,
            'json' => $json,
            'prodi' => $modelProdi,
            'untuk' => 'lihat',
            'led' => $ledProdi,
            'json_eksternal' => $json_eksternal,
            'json_profil' => $json_profil,
            'json_analisis' => $json_analisis,
            'modelEksternal' => $modelEksternal,
            'modelAnalisis' => $modelAnalisis,
            'modelProfil' => $modelProfil,
        ]) ?>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Laporan Kinerja Program Studi
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-actions">
                        <strong>Perkembangan Pengisian &nbsp;: <?= $lkProdi->progress ?> %</strong>
                        <div class="kt-space-10"></div>
                        <?=
                        Progress::widget([
                            'percent' => $lkProdi->progress,
                            'barOptions' => ['class' => 'progress-bar-info m-progress-lg'],
                            'options' => ['class' => 'progress-sm']
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-section">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Kriteria Akreditasi</th>
                            <th style="width: 110px"></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($jsonLk as /* @var Lk */
                                       $kriteriaJson): ?>
                            <tr>
                                <th scope="row"><?= Html::encode($kriteriaJson->kriteria) ?></th>
                                <td>
                                    <strong>Tabel <?= Html::encode($kriteriaJson->kriteria) ?>
                                        : <?= $kriteriaLk[$kriteriaJson->kriteria - 1]->progress ?>%</strong><br>
                                    <?= $kriteriaJson->judul ?>
                                    <div class="kt-space-10"></div>
                                    <?=
                                    Progress::widget([
                                        'percent' => $kriteriaLk[$kriteriaJson->kriteria - 1]->progress,
                                        'barOptions' => ['class' => 'progress-bar-info m-progress-lg'],
                                        'options' => ['class' => 'progress-sm']
                                    ]); ?>
                                </td>
                                <td style="padding-top: 15px;">
                                    <?= Html::a("<i class='la la-folder-open'></i>Lihat", [
                                        'lk/lihat-kriteria',
                                        'lk' => $_GET['id'],
                                        'kriteria' => $kriteriaJson->kriteria,
                                        'prodi' => $modelProdi->id
                                    ], ['class' => 'btn btn-default btn-pill btn-elevate btn-elevate-air']) ?>

                                    <!--                        <button type="button" class="btn btn-danger">Lihat</button>-->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
