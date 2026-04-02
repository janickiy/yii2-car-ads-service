<?php

declare(strict_types=1);

namespace app\modules\api;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\\modules\\api\\controllers';

    public function init(): void
    {
        parent::init();
    }
}
