Yii2 Gallery widget
===================
blueimp gallery in your Yii2 application with fileupload

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

You must add to your config:
```
'modules' => [
		//...
        'gallery' => [
            'class' => 'onmotion\gallery\Module',
        ],
        //...
    ]
```