<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BooksSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => [
            'data-pjax' => true
        ],
    ]); ?>
    <?= $form->field($model, 'booksSize')->dropDownList([
        5 => 5,
        7 => 7,
        9 => 9,
        10 => 10
    ], [
        'id'=>'booksSize'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
