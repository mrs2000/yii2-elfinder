<?php

namespace mihaildev\elfinder;

use Yii;
use yii\helpers\ArrayHelper;

class LocalPath extends BasePath
{
    public $path;
    public $baseUrl = '@web';
    public $basePath = '@webroot';

    public $name = 'Root';

    public $uploadMaxSize = 0;

    public $options = [];

    public $access = ['read' => '*', 'write' => '*'];

    public function getUrl()
    {
        return Yii::getAlias($this->baseUrl . '/' . trim($this->path, '/'));
    }

    public function getRealPath()
    {
        $path = Yii::getAlias($this->basePath . '/' . trim($this->path, '/'));
        if (!is_dir($path) && !mkdir($path) && !is_dir($path)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
        }

        return $path;
    }

    public function getRoot()
    {
        $options['driver'] = $this->driver;
        $options['path'] = $this->getRealPath();
        $options['URL'] = $this->getUrl();
        $options['defaults'] = $this->getDefaults();
        $options['alias'] = $this->getAlias();
        $options['uploadMaxSize'] = $this->uploadMaxSize;
        $options['mimeDetect'] = 'internal';
        //$options['onlyMimes'] = ['image'];
        $options['imgLib'] = 'gd';
        $options['attributes'][] = [
            'pattern' => '#.*(\.tmb|\.quarantine)$#i',
            'read' => false,
            'write' => false,
            'hidden' => true,
            'locked' => true
        ];

        return ArrayHelper::merge($options, $this->options);
    }
} 