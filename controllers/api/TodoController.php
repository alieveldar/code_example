<?php

namespace app\controllers\api;

use app\models\TodoApi;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Request;
use yii\web\ServerErrorHttpException;

class TodoController extends Controller
{
    /**
     * @param integer $id
     *
     * @return TodoApi
     * @throws NotFoundHttpException
     * @throws ServerErrorHttpException
     */
    public function actionUpdate(int $id): TodoApi
    {
        /** @var Request $request */
        $request = $this->request;
        $model = $this->getModel($id);
        $model->setAttribute('done', $request->getBodyParam('done'));

        if ($model->update() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }

        return $model;
    }

    /**
     * @param int $id
     *
     * @return TodoApi
     * @throws NotFoundHttpException
     */
    private function getModel(int $id): TodoApi
    {
        if (($model = TodoApi::findOne($id)) === null) {
            throw new NotFoundHttpException('Todo record not found.');
        }

        return $model;
    }
}
