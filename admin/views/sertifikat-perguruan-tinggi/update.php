<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $namaInstitusi */
/* @var $model common\models\sertifikat\SertifikatInstitusi */

$this->title = 'Ubah Sertifikat Institusi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sertifikat Institusi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>

<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-edit"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="sertifikat-institusi-update">

                    <?= $this->render('_form-update', [
                    'model' => $model,
                    'namaInstitusi' =>$namaInstitusi
                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



