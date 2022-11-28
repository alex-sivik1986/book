<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/** @var yii\web\View $this */
/** @var common\models\Books $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="books-form">

    <?php $form = ActiveForm::begin(['options' => ['options' => ['enctype' => 'multipart/form-data']]]); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release')->widget(\kartik\datetime\DateTimePicker::class,
        [
            'options' => ['placeholder' => 'Оберіть дату ...'],
            'convertFormat' => true,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-MM-yyyy',
                'minView' => 2
            ],
        ]) ?>
    <? if($model->preview): ?>
        <div class="container" id="img-container">
            <div>
        <span class="close-image-icon">
          <button type="button" class="close m-4" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </span>
            <?= Html::img(\yii\helpers\Url::to('/frontend/web/uploads/'. $model->id . '/' .$model->preview),
                [
                    'width' => '200px',
                    'style' => 'margin:5px'
                ])?>
            </div>
        </div>
    <? endif; ?>
    <?= $form->field($model, 'preview')->fileInput() ?>

    <?= $form->field($model, 'author_id')->dropDownList(
            ArrayHelper::map($authors,'id', 'surname', 'name'),
            [
                'prompt' => 'Оберіть автора',
            ])->label('Author') ?>

    <?= $form->field($model, 'janrs_book')->widget(Select2::class, [
        'data' => ArrayHelper::map($janr,'id','name'),
        'options' => ['placeholder' => 'Оберіть жанр ...', 'multiple' => true],
        'pluginOptions' => [
            'tags' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ])->label('Жанри книги'); ?>


    <div class="form-group">
        <?= Html::submitButton('Записати', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style>
    .select2-container--krajee-bs4 .select2-selection--multiple .select2-search--inline .select2-search__field {
        margin: 0rem;
        min-width: 0em;
    }
    .container>div {
        position: relative;
        /* Чтобы .close не выходил за рамки .container */
    }
    .close:not(:disabled):not(.disabled):hover, .close:not(:disabled):not(.disabled):focus {
        opacity: 1;
    }
    .close {
        position: absolute;
        left: 200px;
        top: -43px;
        /* Ставим крестик справа */
    }

    .close-image-icon {
        display: none;
        /* Скрываем крестик по умолчанию */
    }

    .container>div:hover .close-image-icon {
        display: block !important;
        /* При навидении на div в .container показать крестик */
    }
</style>

<?php
    $this->registerJs('
        jQuery("body").on("click", ".close.m-4", function() {
            var id = '.$model->id.'
            $.ajax({
                type: "POST",
                cache: false,
                data:{"dataId": id},
                url: "'.Yii::$app->getUrlManager()->createUrl("books/delete-img").'",
                dataType: "json",
                success: function(data){ 
                           if(data.status == "success") {
                                $( "div#img-container" ).remove();
                           }
                        }
            });
        });
    ');
?>