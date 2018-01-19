<?php

namespace mihaildev\elfinder;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class AssetsCallBack extends AssetBundle
{
    public $js = [
        'js/elfinder.callback.js'
    ];
    public $depends = [
        JqueryAsset::class
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
} 