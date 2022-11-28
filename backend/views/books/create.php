<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Books $model */

$this->title = 'Створити';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'authors' => $authors,
        'janr' => $janr
    ]) ?>

</div>
