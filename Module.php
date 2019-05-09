<?php

namespace onmotion\gallery;

/**
 * gallery module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'onmotion\gallery\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $view = \Yii::$app->getView();
        FileInputAsset::register($view);
        GalleryAsset::register($view);
        ModuleAsset::register($view);
    }

}
