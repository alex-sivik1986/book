<?php

use common\models\Books;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\BooksSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Книжки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Створити', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin([
            'id' => 'all_books',
            'timeout' => false,
            'enablePushState' => false,
            'clientOptions' => ['method' => 'POST']
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'preview',
                'format' => 'html',
                'value' => function($data) {
                    return $data->preview?Html::img(Url::to('/frontend/web/uploads/'. $data->id . '/' .$data->preview), ['width' => '70px']):'';
                }
            ],
            'name:ntext',
            [
                'attribute' => 'release',
                'value' => function($data) {
                    return \Yii::$app->formatter->asDate($data->release, 'medium');
                },
                'filter' => \kartik\daterange\DateRangePicker::widget([
                    'model'=> $searchModel,
                    'attribute' => 'release',
                    'useWithAddon'=>false,
                    'convertFormat'=>true,
                    'startAttribute' => 'datetime_start',
                    'endAttribute' => 'datetime_end',
                    'pluginOptions'=>[
                        'locale'=>['format' => 'd-m-Y'],
                    ]
                ])
            ],
            [
                'label' => 'Автори книг',
                'attribute'=>'authorBook',
                'value' => function($model) {
                    return $model->author->name . ' ' . $model->author->surname;
                }
            ],
            [
                'label' => 'Жанри',
                'attribute'=>'janrsBook',
                'format'=>'text',
                'filter' => $janrsAll,
                'value' => function($model) {
                    $janrs = array_column($model->getJanrs()->asArray()->all(),'name');
                    return implode(", ", $janrs);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \common\models\Books $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
