<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FakultasAkademi */
/* @var $jenis array */

$this->title = 'Update Fakultas / Akademi / Pascasarjana: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Fakultas', 'url' => ['/fakultas/arsip/index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['default/index', 'fakultas' => $model->id]];
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
                <div class="program-studi-update">

                    <?= $this->render('@admin/views/fakultas-akademi/_form', [
                    'model' => $model,
                        'jenis'=>$jenis

                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



