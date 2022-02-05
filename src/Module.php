<?php

namespace huzhenghui\yii2\app_basic\site;

use Yii;

use huzhenghui\yii2\app_basic\layout\Module as LayOutModule;

/**
 * basicsite module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'huzhenghui\yii2\app_basic\site\controllers';

    public function init()
    {
        parent::init();
        $basiclayout = Yii::$app->getModule('basiclayout');
        if ($basiclayout instanceof LayOutModule) {
            $basiclayout->getNavItemsCollection()->append(new NavItems());
        }
    }
}
