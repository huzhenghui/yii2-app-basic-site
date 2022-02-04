<?php

namespace huzhenghui\yii2\app_basic\site\controllers;

use Yii;

use app\controllers\SiteController as AppSiteController;

use huzhenghui\yii2\app_basic\site\models\LoginForm;
use huzhenghui\yii2\app_basic\site\models\ContactForm;

class SiteController extends AppSiteController
{
    public function init()
    {
        parent::init();
        $layoutModule = \Yii::$app->getModule('basiclayout');
        $layoutViewPath = $layoutModule->getViewPath();
        $appAlias = \Yii::getAlias('@app');
        if (0 === strpos($layoutViewPath, $appAlias)) {
            $layout = '@app' . substr($layoutViewPath, strlen($appAlias)) . '/layouts/main';
        }
        $this->layout = $layout;
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
}
