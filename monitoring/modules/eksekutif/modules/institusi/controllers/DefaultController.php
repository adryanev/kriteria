<?php

namespace monitoring\modules\eksekutif\modules\institusi\controllers;

use yii\web\Controller;

/**
 * Default controller for the `eksekutif-institusi` module
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
