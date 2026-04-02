<?php

namespace app\commands;

use yii\console\Controller;

class HelloController extends Controller
{
    public function actionIndex(string $name = 'world'): void
    {
        $this->stdout("Hello, {$name}!\n");
    }
}
