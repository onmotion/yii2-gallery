<?php

use kartik\file\FileInput;
use onmotion\gallery\Gallery;
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use onmotion\helpers\Translator;

/* @var $this yii\web\View */
/* @var $model onmotion\gallery\models\Gallery */
/* @var $photos onmotion\gallery\models\GalleryPhoto */

set_time_limit(60);
ini_set('memory_limit', '512M');

$this->params['breadcrumbs'][] = ['label' => 'Gallery', 'url' => ['/gallery']];
$this->params['breadcrumbs'][] = $model->name;

$this->registerJs(<<<JS
$('#preloader').show();
$('body').css('overflow', 'hidden');
window.onload = function() {
	$('body').css('overflow', 'auto');
    $('#preloader').hide();
  };
   $("[data-toggle='tooltip']").tooltip();
JS
);
            echo Html::beginTag('div', ['class' => 'gallery-view']);
            echo \yii\bootstrap\Collapse::widget([
                'items' => [
                    [
                        'label' => $model->name . ' (' . count((array)$photos) . ' photos)',
                        'content' => !empty($model->descr) ? $model->descr : ''
                    ]
                ],
                'options' => [
                    'class' => 'header-collapse'
                ]
            ]);
            $galleryName = $model->name;

            if (!empty($photos)) {
                foreach ($photos as $photo) {
                    $items[] =
                        [
                            'original' => '/img/gallery/' . Translator::rus2translit($galleryName) . '/' . $photo->name,
                            'thumbnail' => '/img/gallery/' . Translator::rus2translit($galleryName) . '/thumb/' . $photo->name,
                            'options' => [
                                'title' => $galleryName,
                                'data-id' => $photo->photo_id,
                            ],
                        ];
                };
            } else {
                echo 'There is no photos yet...';
            }
            ?>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <?php
                    if (!empty($items))
                        echo Gallery::widget([
                            'id' => 'gallery-links',
                            'items' => $items,
                            'pluginOptions' => [
                                'slideshowInterval' => 2000,
                                'transitionSpeed' => 200,
                                ],
                        ]);
                    ?>
                </div>
                <div class="col-md-1"></div>
            </div>
            <?php
            echo Collapse::widget([
                'items' => [
                    [
                        'label' => 'Upload photo',
                        'content' => FileInput::widget([
                                'name' => 'image[]',
                                'language' => 'en',
                                'options' => [
                                    'multiple' => true,
                                ],
                                'pluginOptions' => [
                                    'showPreview' => false,
                                    'uploadUrl' => Url::to(['fileupload']),
                                    'uploadExtraData' => [
                                        'gallery_id' => $model->gallery_id,
                                        'gallery_name' => $model->name,
                                    ],
                                    'allowedFileExtensions' => ["jpg", "png"],
                                    'allowedFileTypes' => ['image'],
                                    'maxFileCount' => 1000,
                                    'maxFileSize' => 15000,
                                    'messageOptions' => [
                                        'class' => 'alert-warning-message'
                                    ],
                                    'elErrorContainer' => '#errorBlock'
                                ],
                                'pluginEvents' => [
                                    'fileuploaded' => NEW \yii\web\JsExpression("function(e){location.reload();}")
                                ],
                            ]) .
                            ' <div id="errorBlock">
                         <ul class="alert-warning-message"></ul>
                         </div>'
                    ]
                ],
                'options' => [
                    'class' => 'download-collapse'
                ]
            ]);
                echo Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['#'],
                    ['title' => 'Edit mode', 'class' => 'btn btn-default', 'id' => 'check-toggle',
                        'data-toggle' => "tooltip", 'data-placement' => "top", 'data-trigger' => "hover"]);
                echo Html::a('<i class="glyphicon glyphicon-check"></i>', ['#'],
                    ['title' => 'Check all', 'class' => 'btn btn-default', 'style' => "display:none", 'id' => 'check-all',
                        'data-toggle' => "tooltip", 'data-placement' => "top", 'data-trigger' => "hover"]);

                echo Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['#'],
                    ['title' => 'Reset', 'class' => 'btn btn-default', 'style' => "display:none", 'id' => 'reset-all',
                        'data-toggle' => "tooltip", 'data-placement' => "top", 'data-trigger' => "hover"]);
                echo Html::a('<i class="glyphicon glyphicon-trash"></i>', Url::toRoute('photos-delete'),
                    ['title' => 'Delete photos', 'class' => 'btn btn-danger', 'style' => "display:none", 'id' => 'photos-delete-btn',
                        'data-toggle' => "tooltip", 'data-placement' => "top", 'data-trigger' => "hover",
                        'role' => 'modal-toggle',
                        'data-modal-title'=>'Delete photos',
                        'data-modal-body'=>'Are you sure?',
                    ]);
echo Html::endTag('div');

Modal::begin([
    "id" => "gallery-modal",
    'header' => '<h4 class="modal-title"></h4>',
    "footer" =>
        Html::a('Close', ['#'],
            ['title' => 'Cancel', 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
        Html::a('ОК', Url::toRoute('photos-delete'),
            ['title' => '', 'class' => 'btn btn-primary', 'id' => 'photos-delete-confirm-btn']),
]);

Modal::end();

echo Html::beginTag('div', ['class' => 'preloader']);
echo Html::tag('div', Html::tag('span', '100', ['class' => 'sr-only']), ['class'=>"progress-bar progress-bar-striped active", 'role'=>"progressbar",
    'aria-valuenow'=>"100", 'aria-valuemin'=>"0", 'aria-valuemax'=>"100", 'style'=>"width:100%"]);
echo Html::endTag('div');
?>