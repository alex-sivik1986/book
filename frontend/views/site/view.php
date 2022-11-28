<?php
/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?=$model->name?></h1>
<div class="row">

    <div class="col-md-6"><?=Html::img('/uploads/'.$model->id.'/'.$model->preview,['width' => '300px'])?></div>
    <div class="col-md-6">
        <h4> Автор: <?=$model->author->name. ' ' .$model->author->surname ?></h4>
        <p>Надрукована в <?=Yii::$app->formatter->asDate($model->release, 'medium') ?></p>
        <p>Жанри: <?=implode(' ,',\yii\helpers\ArrayHelper::map($model->janrs,'id','name'))?></p>
        <p>Опис: <?=$model->description?></p>
    </div>
  </div>



</div>
