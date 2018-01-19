<?php

namespace mihaildev\elfinder;

use Yii;

class UserPath extends LocalPath
{
    public function isAvailable()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        return parent::isAvailable();
    }

    public function getUrl()
    {
        $path = strtr($this->path, ['{id}' => Yii::$app->user->id]);
        return Yii::getAlias($this->baseUrl . '/' . trim($path, '/'));
    }

    public function getRealPath()
    {
        $path = strtr($this->path, ['{id}' => Yii::$app->user->id]);
        $path = Yii::getAlias($this->basePath . '/' . trim($path, '/'));
        if (!is_dir($path) && !mkdir($path) && !is_dir($path)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
        }

        return $path;
    }
}