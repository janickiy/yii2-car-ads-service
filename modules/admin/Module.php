<?php

declare(strict_types=1);

namespace app\modules\admin;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $defaultRoute = 'site/index';

    public function init(): void
    {
        parent::init();
    }
}
