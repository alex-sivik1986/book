<?php

use common\models\Janr;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\JanrSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Жанри';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="janr-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Створити жанр', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Janr $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
