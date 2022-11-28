<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Books $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Книжки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:ntext',
            'description',
            [
                'attribute' => 'author',
                'value' => function($data) {
                    return $data->author->name. ' ' .$data->author->surname;
                }
            ],
            [
                'attribute' => 'release',
                'value' => function($data) {
                    return date('d-M-Y', strtotime($data->release));
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
