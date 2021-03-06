<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Profil */
/* @var $strukturModel akreditasi\models\kriteria9\forms\StrukturOrganisasiUploadForm */

$this->title = 'Ubah Profil Institusi';
$this->params['breadcrumbs'][] = ['label' => 'Profil Institusi', 'url' => ['index']];
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
                <div class="profil-institusi-update">

                    <?= $this->render('_form', [
                    'model' => $model,
                        'strukturModel'=>$strukturModel
                    ]) ?>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



