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
        'css/onmotion-gallery.css',
    ];
    public $js = [
        'js/onmotion-bootstrap-modal.js',
        'js/onmotion-gallery.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
