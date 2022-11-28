<?php

namespace backend\controllers;

use common\models\Author;
use common\models\Books;
use common\models\Janr;
use common\models\BooksJanr;
use common\models\BooksSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
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
     * Lists all Books models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->post());
        $janrsAll = ArrayHelper::map(Janr::find()->asArray()->all(), 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'janrsAll' => $janrsAll
        ]);
    }

    /**
     * Displays a single Books model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Books();
        $authors = Author::find()->asArray()->all();
        $janr = Janr::find()->asArray()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->data_image = UploadedFile::getInstance($model, 'preview');
                $model->preview = $model->data_image->name;
                if($model->save()) {
                    $model->upload($model->id);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'authors' => $authors,
            'janr' => $janr
        ]);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $authors = Author::find()->asArray()->all();
        $janr = Janr::find()->asArray()->all();
        $oldImage = $model->preview;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->data_image = UploadedFile::getInstance($model, 'preview');
            ($model->data_image!=NULL?$model->preview = $model->data_image->name:$model->preview = $oldImage);

            if($model->save()) {
                $model->upload($model->id);
            } else {
                return ErrorAction::class;
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'authors' => $authors,
            'janr' => $janr
        ]);
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteImg()
    {
        \Yii::$app->response->format = \yii\web\response::FORMAT_JSON;

        if ($this->request->isAjax && \Yii::$app->request->post('dataId')) {
            $id = \Yii::$app->request->post('dataId');
            $model = $this->findModel($id);
            unlink($_SERVER['DOCUMENT_ROOT'].'/frontend/web/uploads/'. $id . '/'.$model->preview);
            $model->preview = '';
            if($model->save()) {
                return [
                    "status" => "success"
                ];
            } else {
                return [
                    "status" => "error"
                ];
            }
        }
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
