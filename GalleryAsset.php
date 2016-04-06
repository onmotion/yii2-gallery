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
class GalleryAsset extends AssetBundle
{
    public $sourcePath = '@bower/blueimp-gallery';
    public $css = [
        'css/blueimp-gallery.min.css',
    ];
    public $js = [
        'js/blueimp-gallery.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
