<?php

namespace app\controllers;

use app\models\Produksi;
use app\models\ProduksiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProdusiController implements the CRUD actions for Produksi model.
 */
class ProdusiController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Produksi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProduksiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produksi model.
     * @param int $id_produksi Id Produksi
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_produksi)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_produksi),
        ]);
    }

    /**
     * Creates a new Produksi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Produksi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_produksi' => $model->id_produksi]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Produksi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_produksi Id Produksi
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_produksi)
    {
        $model = $this->findModel($id_produksi);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_produksi' => $model->id_produksi]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Produksi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_produksi Id Produksi
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_produksi)
    {
        $this->findModel($id_produksi)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produksi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_produksi Id Produksi
     * @return Produksi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_produksi)
    {
        if (($model = Produksi::findOne(['id_produksi' => $id_produksi])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
