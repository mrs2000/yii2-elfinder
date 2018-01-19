<?php

namespace mihaildev\elfinder;

use yii\web\AssetBundle;

class Assets extends AssetBundle
{
    public $css = [
        'css/elfinder.min.css',
        'css/theme.css',
    ];
    public $js = [
        'js/elfinder.min.js'
    ];
    public $depends = [
        'yii\jui\JuiAsset',
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }

    /**
     * @param string $lang
     * @param \yii\web\View $view
     */
    public static function addLangFile($lang, $view)
    {
        $lang = ElFinder::getSupportedLanguage($lang);

        if ($lang !== false) {
            list(, $path) = \Yii::$app->assetManager->publish(__DIR__ . '/assets');
            $view->registerJsFile($path . '/js/i18n/elfinder.' . $lang . '.js', ['depends' => [self::className()]]);
        }
    }
}
