<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel onmotion\gallery\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photo-gallery';
$dataProvider->pagination->pageSize = 20;
?>
<div class="gallery-index">

            <?php
    echo Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
        ['title' => 'Create Gallery', 'class' => 'btn btn-default',
            'method' => 'get',
            'role' => 'modal-toggle',
            'data-modal-title'=>'Create Gallery',
        ]);
            
    echo \yii\widgets\ListView::widget([
        'id' => 'gallery-listview',
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}\n{summary}",
        'itemView' => function ($model) {
            return $this->render('galleryItem',['model' => $model]);
        },
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
            'nextPageLabel' => '>',
            'prevPageLabel' => '<',
        ],
        
    ]);

    ?>
    </div>

<?php
Modal::begin([
    "id" => "gallery-modal",
    'header' => '<h4 class="modal-title"></h4>',
    "footer" =>
        Html::a('Close', ['#'],
            ['title' => 'Cancel', 'class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
        Html::a('ОК', Url::to('#'),
            ['title' => '', 'class' => 'btn btn-primary', 'id' => 'modal-confirm-btn']),
]);

echo Html::beginTag('div', ['class' => 'preloader']);
echo Html::tag('div', Html::tag('span', '100', ['class' => 'sr-only']), ['class'=>"progress-bar progress-bar-striped active", 'role'=>"progressbar",
  'aria-valuenow'=>"100", 'aria-valuemin'=>"0", 'aria-valuemax'=>"100", 'style'=>"width:100%"]);
echo Html::endTag('div');
Modal::end(); ?>
