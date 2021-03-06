<?php

namespace admin\controllers;

use admin\models\K9AkreditasiInstitusiForm;
use admin\models\K9AkreditasiInstitusiSearch;
use common\models\kriteria9\akreditasi\K9Akreditasi;
use common\models\kriteria9\akreditasi\K9AkreditasiInstitusi;
use Yii;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AkreditasiProdiController implements the CRUD actions for K9AkreditasiProdi model.
 */
class AkreditasiPerguruanTinggiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['actions' => ['index', 'create', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all K9AkreditasiProdi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new K9AkreditasiInstitusiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single K9AkreditasiProdi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new K9AkreditasiProdi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new K9AkreditasiInstitusiForm();
        $idAkreditasi = K9Akreditasi::findAll(['jenis_akreditasi'=>'institusi']);
        $dataAkreditasi = ArrayHelper::map($idAkreditasi, 'id', 'nama');


        if ($model->load(Yii::$app->request->post())) {
            if ($model->createAkreditasi()) {
                Yii::$app->session->setFlash('success', 'Berhasil menambahkan Akreditasi Institusi');
                return $this->redirect(['akreditasi-perguruan-tinggi/index']);
            }
        } elseif (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', ['model' => $model,
                'dataAkreditasi' => $dataAkreditasi,
                ]);
        }
        return $this->render('create', [
            'model' => $model,
            'dataAkreditasi' => $dataAkreditasi,
        ]);
    }



    /**
     * Deletes an existing K9AkreditasiInstitusi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->deleteFolder($id);
        $model->delete();


        Yii::$app->session->setFlash('success', 'Berhasil menghapus AkreditasiProdi.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the K9AkreditasiInstitusi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return K9AkreditasiInstitusi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = K9AkreditasiInstitusi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function deleteFolder($id)
    {
        $model = $this->findModel($id);
        $path = Yii::getAlias('@uploadAkreditasi');
        $pathData = Yii::$app->params['uploadPath'];
        $replacement = [
            '{lembaga}'=>$model->akreditasi->lembaga,
            '{jenis_akreditasi}'=>$model->akreditasi->jenis_akreditasi,
            '{tahun}'=>$model->akreditasi->tahun,
            '{level}'=>'institusi',
            '{id}'=>'',
        ];
        $result = strtr($pathData,$replacement);

        $realPath = "$path/$result";

        try {
            FileHelper::removeDirectory($realPath);
        } catch (ErrorException $e) {
            throw $e;
        }

    }
}
