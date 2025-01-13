<?php

use app\models\Todo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TodoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::$app->name;
?>

<div class="todo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Todo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'headerOptions' => ['style' => 'width: 60px; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
            ],
            'title:ntext',
            [
                'attribute' => 'priority',
                'headerOptions' => ['style' => 'width: 100px; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
            ],
            [
                'attribute' => 'done',
                'filter' => [1 => 'Yes', 0 => 'No'],
                'filterInputOptions' => ['prompt' => 'All', 'class' => 'form-control'],
                'headerOptions' => ['style' => 'width: 95px; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->done ? 'Yes' : 'No';
                },
            ],
            [
                'class' => ActionColumn::class,
                'headerOptions' => ['style' => 'width: 80px; text-align: center;'],
                'contentOptions' => ['style' => 'text-align: center;'],
                'urlCreator' => function ($action, Todo $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>

</div>
