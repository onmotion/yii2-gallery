Yii2 Gallery module
===================
blueimp gallery in your Yii2 application with fileupload

[![Latest Stable Version](https://poser.pugx.org/onmotion/yii2-gallery/v/stable)](https://packagist.org/packages/onmotion/yii2-gallery)
[![Total Downloads](https://poser.pugx.org/onmotion/yii2-gallery/downloads)](https://packagist.org/packages/onmotion/yii2-gallery)
[![Monthly Downloads](https://poser.pugx.org/onmotion/yii2-gallery/d/monthly)](https://packagist.org/packages/onmotion/yii2-gallery)
[![License](https://poser.pugx.org/onmotion/yii2-gallery/license)](https://packagist.org/packages/onmotion/yii2-gallery)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist onmotion/yii2-gallery "*"
```

or add

```
"onmotion/yii2-gallery": "*"
```

to the require section of your `composer.json` file.


Usage
-----

1. You must add to your config:
```
'modules' => [
		//...
        'gallery' => [
            'class' => 'onmotion\gallery\Module',
        ],
        //...
    ]
```

1. Apply migration, run:
```
php yii migrate --migrationPath=@vendor/onmotion/yii2-gallery/migrations
```

1. Go to your application in your browser
```
http://your-host/gallery
```
If you want change the view, you can add to your config:
```
 'components' => [
        //...
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@vendor/onmotion/yii2-gallery/views/default' => '@app/views/gallery', // example: @app/views/gallery/default/index.php
                ],
            ],
        ],
        //...
    ],
```
then you need to copy directory 'default' from @vendor/onmotion/yii2-gallery/views to @app/views/gallery and change it as you want.


![](https://raw.githubusercontent.com/onmotion/yii2-gallery/master/samples/sample1.png)

![](https://raw.githubusercontent.com/onmotion/yii2-gallery/master/samples/sample2.png)

More samples how it works you can see at [blueimp gallery page](https://github.com/blueimp/Gallery/blob/master/README.md)
