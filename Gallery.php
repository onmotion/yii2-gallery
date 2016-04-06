<?php
/**
 * Created by PhpStorm.
 * User: kozhevnikov
 * Date: 31.03.2016
 * Time: 14:44
 */

namespace onmotion\gallery;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * Class Gallery
 * @package onmotion\gallery
 */
class Gallery extends Widget
{
    public $id;

    public $items = [];

    public $pluginOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
       

        if (!isset($this->id))
            $this->id = $this->getId();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (empty($this->items)) {
            return null;
        }
        $this->renderPreloader();
        $this->renderGallery();

        $options = [];
        foreach ($this->pluginOptions as $k => $v) {
            $options[$k] = new JsExpression($v);
        }
        $options = Json::encode($options);
        $view = self::getView();
        $view->registerJs(
            <<<JS
 onmotion.gallery('$this->id', $options);
JS
        );
    }

    /**
     *
     */
    public function renderGallery()
    {
        $links = [];
        foreach ($this->items as $item) {
            $originalImg = Html::encode($item['original']);
            $thumbImg = ArrayHelper::getValue($item, 'thumbnail', $originalImg);    //if thumb is empty return original image, but it made render slowly.
            isset($item['options']['class']) ? $item['options']['class'] .= ' gallery-item' : $item['options']['class'] = 'gallery-item';
            $links[] = Html::a(Html::img($thumbImg), $originalImg, $item['options']);
        }
        $controls =
            Html::tag('div', '', ['class' => 'slides']) .
            Html::tag('h3', '', ['class' => 'title']) .
            Html::tag('a', '‹', ['class' => 'prev']) .
            Html::tag('a', '›', ['class' => 'next']) .
            Html::tag('a', '×', ['class' => 'close']) .
            Html::tag('a', '', ['class' => 'play-pause']);

        echo Html::tag('div', implode("\n", array_filter($links)), ['id' => $this->id]);
        echo Html::tag('div', $controls, ['id' => 'blueimp-gallery', 'class' => 'blueimp-gallery blueimp-gallery-controls']);
    }

    public function renderPreloader()
    {
        $inner = <<<HTML
        <div class="block">
            <div class="loading">
                <div data-loader="circle-side"></div>
            </div>
        </div>
HTML;
        echo Html::tag('div', $inner,['id' => 'preloader', 'class' => 'preloader-hide', 'style' => 'background: rgba(0,0,0,.8)']);
    }
    
}
