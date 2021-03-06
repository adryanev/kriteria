<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\sertifikat\SertifikatInstitusi */
/* @var $namaInstitusi */

$this->title = 'Tambah Sertifikat Institusi';
$this->params['breadcrumbs'][] = ['label' => 'Sertifikat Institusi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-add-1"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="sertifikat-institusi-create">

                    <?= $this->render('_form', [
                    'model' => $model,
                    'namaInstitusi' => $namaInstitusi
                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>

