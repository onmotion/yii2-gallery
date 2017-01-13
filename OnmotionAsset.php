<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 31.03.2016
 * Time: 14:47
 */

namespace onmotion\gallery;

use yii\web\AssetBundle;

/**
 * Class GalleryAsset
 * @package onmotion\gallery
 */
class OnmotionAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';
    public $css = [
        'bootstrap-fileinput-4.3.1/css/fileinput.min.css',
        'css/onmotion-gallery.css',
    ];
    public $js = [
        'bootstrap-fileinput-4.3.1/js/plugins/canvas-to-blob.min.js',
        'bootstrap-fileinput-4.3.1/js/fileinput.min.js',
        'js/onmotion-bootstrap-modal.js',
        'js/onmotion-gallery.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
