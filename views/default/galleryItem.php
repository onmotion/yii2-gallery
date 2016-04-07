<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 17.03.2016
 * Time: 13:32
 */

use yii\helpers\Html;
use yii\helpers\Url;
use onmotion\helpers\Translator;

$date = new DateTime($model->date);

?>

<div class="gallery-item">
    <div class="image">
        <?php
            echo Html::beginTag('div', ['class' => 'change-btns']);
            echo Html::a('<i class="glyphicon glyphicon-trash"></i>', Url::toRoute(["delete", 'id'=>$model->gallery_id]),
                ['title' => 'Delete',
                    'class' => 'update-btn',
                    'role' => 'modal-toggle',
                    'data-modal-title'=>'Are you sure?',
                    'data-modal-body'=>'This will permanently delete all the pictures are in the gallery.',
                ]);
            echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', Url::toRoute(["update", 'id'=>$model->gallery_id]), [
                'title' => 'Update',
                'method' => 'get',
                'class'=>"update-btn",
                'role'=>"modal-toggle",
                'data-modal-title'=>'Update',
            ]);
            echo Html::endTag('div');
        ?>

        <a class="image-wrap" href="<?= Url::toRoute(["view", 'id'=>$model->gallery_id]) ?>">
            <?php
            foreach($model->galleryPhotos as $prevPhoto){
                echo \yii\helpers\Html::img('/img/gallery/' . Translator::rus2translit($model->name) . '/thumb/' . $prevPhoto->name);
            };
            ?>
        </a>
    </div>
    <div class="name">
        <span><?= $model->name ?></span>
        <span class="date-gallery"><?= ' (' . $date->format('d.m.Y') . ')'  ?></span>
    </div>
</div>
