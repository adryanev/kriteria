<?php
/**
 * @var $this yii\web\View
 * @var $modelDokumen K9DokumenLedInstitusiUploadForm;
 * @var $dataDokumen [];
 * @var $path string
 * @var $untuk string
 */

use akreditasi\models\kriteria9\forms\led\K9DokumenLedInstitusiUploadForm;
use common\helpers\FileIconHelper;
use common\helpers\FileTypeHelper;
use common\models\Constants;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;

$controller = $this->context->id;
?>

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Dokumen LED
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-actions">
                <?php if ($untuk === 'isi'): ?>
                    <?php Modal::begin([
                        'title' => 'Unggah Dokumen Led',
                        'toggleButton' => [
                            'label' => '<i class="la la-upload"></i> &nbsp;Unggah',
                            'class' => 'btn btn-primary btn-pill btn-elevate btn-elevate-air'
                        ],
                        'size' => 'modal-lg',
                        'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true]
                    ]); ?>
                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data'],
                        'id' => 'dokumen-led-form'
                    ]) ?>

                    <?= $form->field($modelDokumen, 'dokumenLed')->widget(FileInput::class, [
                        'pluginOptions' => [
                            'allowedFileExtensions' => Constants::ALLOWED_EXTENSIONS,
                        ]
                    ]) ?>

                    <div class="form-group pull-right">
                        <?= Html::submitButton('<i class="la la-save"></i> Simpan',
                            ['class' => 'btn btn-primary btn-pill btn-elevate btn-elevate-air']) ?>
                    </div>
                    <?php ActiveForm::end() ?>

                    <?php Modal::end(); ?>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <div class="kt-portlet__body">
        <div class="kt-section kt-section--first" style="margin-bottom: 0;">
            <table class="table table-hover table-light table-striped">
                <thead class="thead-light">
                <tr>

                    <th>No.</th>
                    <th>Dokumen Led</th>
                    <th>Dibuat Tanggal</th>
                    <th>Jenis</th>
                    <th>
                        Aksi
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($dataDokumen as $key => $item) : ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <?= FileIconHelper::getIconByExtension($item->bentuk_dokumen) ?>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <?= Html::encode($item->nama_dokumen) ?>

                                </div>
                            </div>
                        </td>
                        <td><?= Yii::$app->formatter->asDatetime($item->created_at) ?></td>
                        <td><?= $item->kode_dokumen ?></td>
                        <td>
                            <div class="row pull-right">
                                <div class="col-lg-12">
                                    <?php $type = FileTypeHelper::getType($item->bentuk_dokumen); ?>
                                    <?php Modal::begin([
                                        'title' => $item->nama_dokumen,
                                        'toggleButton' => [
                                            'label' => '<i class="la la-eye"></i> &nbsp;Lihat',
                                            'class' => 'btn btn-info btn-pill btn-elevate btn-elevate-air'
                                        ],
                                        'size' => 'modal-lg',
                                        'clientOptions' => ['backdrop' => 'blur', 'keyboard' => true]
                                    ]); ?>
                                    <?php echo ' <div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://docs.google.com/gview?url=' . $path . '/' . rawurlencode($item->nama_dokumen) . '&embedded=true"></iframe></div>'; ?>
                                    <?php Modal::end(); ?>
                                    <?= Html::a('<i class ="la la-download"></i> Unduh',
                                        [$controller . '/download-dokumen', 'dokumen' => $item->id],
                                        ['class' => 'btn btn-warning btn-pill btn-elevate btn-elevate-air']) ?>
                                    <?= $untuk === 'isi' ? Html::a('<i class ="la la-trash"></i> Hapus',
                                        [$controller . '/hapus-dokumen-led'], [
                                            'class' => 'btn btn-danger btn-pill btn-elevate btn-elevate-air',
                                            'data' => [
                                                'method' => 'POST',
                                                'confirm' => 'Apakah anda yakin menghapus item ini?',
                                                'params' => ['id' => $item->id]
                                            ]
                                        ]) : '' ?>
                                </div>

                            </div>


                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

