<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\icons\FontAwesomeAsset;
/** @var yii\web\View $this */
/** @var common\models\Author $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="author-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'surname')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->widget(\kartik\datetime\DateTimePicker::class,
        [
            'options' => ['placeholder' => 'Оберіть дату ...'],
            'convertFormat' => true,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-MM-yyyy',
                'minView' => 2
            ]
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Створити', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
