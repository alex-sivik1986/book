<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';

?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Ласкаво просимо!</h1>
    </div>

    <div class="body-content">

        <div class="container">
            <?php \yii\widgets\Pjax::begin(
                    [
                        'timeout' => 10000,
                        'enablePushState' => false,
                        'enableReplaceState' => false,
                    ]) ?>

            <div id="content-replace">
                <?=
                \yii\widgets\ListView::widget([
                    'dataProvider' => new \yii\data\ActiveDataProvider([
                        'query' =>   \common\models\Books::find()->with(['janrs','author']),
                        'pagination' => [
                            'pageSize' => \Yii::$app->request->get('per-page')?\Yii::$app->request->get('per-page'):$choice,
                        ],
                    ]),
                    'itemView' => '_item',
                    'layout' => '{items}<div class="row col-md-12" style="margin-top: 25px"><div class="col-md-6">{summary}</div><div class="col-md-6">{pager}</div></div>',
                    'emptyText' => 'Книг немає',
                    'options' => [
                        'tag' => 'div',
                        'class' => 'row',
                    ],
                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => 'col-6 col-md-3',
                    ],
                    'pager' => [
                        'firstPageLabel' => 'Перша',
                        'lastPageLabel' => 'Остання',
                        'maxButtonCount' => 5,
                        'options' => [
                            'tag' => 'div',
                            'class' => 'pagination'
                        ],
                    ],
                ]);
                ?>
            </div>
            <?php \yii\widgets\Pjax::end(); ?>
            <?=\yii\helpers\Html::dropDownList('changeSize', $choice, \common\models\Books::BOOK_SHOW_IN_PAGE,
                [   'class' => 'col-md-4 form-control',
                    'onchange'=>'$.pjax.reload({container: "#p0", url: "'.\yii\helpers\Url::to(['site/index']).'", method:"post", data: {changeSize: $(this).val()}});',
                ]) ?>
        </div>

    </div>
</div>
<?php
$url = \yii\helpers\Url::to(['site/index']);
/*
    $this->registerJs(
       "$(document).on('change', 'select#change', function(){

    $.pjax.reload({container: '#p0', async: false});

})"
    );
*/
?>