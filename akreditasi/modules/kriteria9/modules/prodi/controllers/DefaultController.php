<?php

namespace akreditasi\modules\kriteria9\modules\prodi\controllers;

use yii\web\Controller;

/**
 * Default controller for the `k9-prodi` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
