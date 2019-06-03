<?php

namespace app\config;

use yii\base\BootstrapInterface;
 
class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        echo 'app running...';
        //$container = \Yii::$container;
        
        //$container->setSingleton(EventDispatcher::class, DummyEventDispatcher::class);
    }
}
