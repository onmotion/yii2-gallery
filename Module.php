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
        GalleryAsset::register($view);
        OnmotionAsset::register($view);
        //route doesn't work
        \Yii::$app->getUrlManager()->addRules([
            '<module:gallery>/<action>' => 'gallery/default/<action>',
        ], false);
    }

}
