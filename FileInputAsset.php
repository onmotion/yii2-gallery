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
class FileInputAsset extends AssetBundle
{
    public $sourcePath = '@npm/bootstrap-fileinput';
    public $css = [
        'css/fileinput.min.css',
    ];
    public $js = [
        'js/fileinput.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
