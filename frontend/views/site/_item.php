<?php
    use yii\helpers\Html;

?>

        <div class="center-block">
            <?php
                if($model->preview) {
                    echo Html::img(\yii\helpers\Url::to('/frontend/web/uploads/'. $model->id . '/' .$model->preview),['height' => '250px', 'class' => 'img-thumbnail']);
                } else {
                    echo Html::img('/frontend/web/uploads/not-found.png');
                }
            ?>
        </div>
        <h2>
            <?=$model->name?>
        </h2>
        <h5>
            <?=$model->author->name. ' ' .$model->author->surname?>
        </h5>
        <p class="center-block ">
            <?= mb_substr($model->description, 0, 25, mb_detect_encoding($model->description))." ..."?>
        </p>
        <p class="center-block"> Жанри:
            <?php
                $janrs = array_column($model->getJanrs()->asArray()->all(),'name');
                echo implode(", ", $janrs);
            ?>
        </p>
        <p class="align-content-center">
            <?php
                echo Html::a('Детальніше', [\yii\helpers\Url::to(['book', 'id' => $model->id])]);
            ?>
        </p>
