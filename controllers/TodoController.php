<?php

namespace app\controllers;

use app\models\Todo;
use app\models\TodoSearch;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;
use yii\web\Response;

class TodoController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function actionIndex(): string
    {
        /** @var Request $request */
        $request = $this->request;
        $queryParams = $request->getQueryParams();

        $model = \Yii::createObject(TodoSearch::class);
        $dataProvider = $model->search($queryParams);

        return $this->render('index', [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->getModel($id),
        ]);
    }

    /**
     * @return string|Response
     * @throws InvalidConfigException
     */
    public function actionCreate()
    {
        /** @var Request $request */
        $request = $this->request;

        $model = \Yii::createObject(TodoSearch::class);
        $model->loadDefaultValues();

        if ($model->load($request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param integer $id
     *
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        /** @var Request $request */
        $request = $this->request;

        $model = $this->getModel($id);

        if ($model->load($request->post())) {
            try {
                $model->update();
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (StaleObjectException $e) {
                \Yii::$app->response->statusCode = 409;
                \Yii::$app->response->statusText = 'Conflict';
                return $this->render('update', [
                    'model' => $model,
                    'showConflictButtons' => true,
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     *
     * @return Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionDelete(int $id): Response
    {
        $model = $this->getModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param int $id
     *
     * @return Todo
     * @throws NotFoundHttpException
     */
    private function getModel(int $id): Todo
    {
        if (($model = Todo::findOne($id)) === null) {
            throw new NotFoundHttpException('Todo record not found.');
        }

        return $model;
    }
}
