<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Books $model */

$this->title = 'Оновити: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Книжки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="books-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'authors' => $authors,
        'janr' => $janr
    ]) ?>

</div>
