<?php

namespace huzhenghui\yii2\app_basic\site;

use Yii;
use yii\bootstrap4\Html;

use huzhenghui\yii2\app_basic\layout\navbar\NavItemsInterface;

class NavItems implements NavItemsInterface
{
    /**
     * {@inheritdoc}
     */
    public function getNavItems()
    {
        return [
            ['label' => 'Home', 'url' => ['site/index']],
            ['label' => 'About', 'url' => ['site/about']],
            ['label' => 'Contact', 'url' => ['site/contact']],
            Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['site/login']]
            ) : ('<li>'
                . Html::beginForm(['site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ];
    }
}
