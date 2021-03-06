<?php

use yii\helpers\Html;
use modules\users\Module;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model modules\users\models\User */
/* @var $assignModel \modules\rbac\models\Assignment */

$this->title = Module::t('module', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="users-backend-profile-index">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Html::encode($model->username); ?></h3>
        </div>
        <div class="nav-tabs-custom">
            <?= Tabs::widget([
                'items' => [
                    [
                        'label' => Html::encode($this->title),
                        'content' => $this->render('tabs/_view', [
                            'model' => $model,
                            'assignModel' => $assignModel,
                        ]),
                        'options' => ['id' => 'profile'],
                        'active' => (!Yii::$app->request->get('tab') || (Yii::$app->request->get('tab') == 'profile')) ? true : false,
                    ],
                ]
            ]); ?>
        </div>
    </div>
</div>
