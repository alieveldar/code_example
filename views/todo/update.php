<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Todo $model */

$this->title = 'Update Todo: ' . $model->title;

$this->params['breadcrumbs'][] = [
    'label' => 'Todo #' . $model->id,
    'url' => ['view', 'id' => $model->id],
];

$this->params['breadcrumbs'][] = 'Update';
?>
<?php if (isset($showConflictButtons)): ?>
    <div class="alert alert-danger">
        <!-- <?= Yii::$app->session->getFlash('error') ?> -->
        <?= Yii::$app->session->getFlash('error') ?? 'Conflict, item was changed by another user, your changes will be lost.' ?>
        <div class="text-right">
            <a href="<?= Url::to(['update', 'id' => $model->id]) ?>" class="btn btn-primary">Edit again</a>
            <a href="<?= Url::to(['index']) ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
<?php endif; ?>
<div class="todo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
