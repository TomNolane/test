<?php

namespace api\modules\v1\controllers;

use Yii;
use api\modules\v1\models\User;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

/**
 * Class UserController
 * @package api\modules\v1\controllers
 */
class UserController extends ActiveController
{
    /**
     * @var string
     */
    public $modelClass = 'api\modules\v1\models\User';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'only' => ['update'],
            'authMethods' => [
                'bearerAuth' => [
                    'class' => HttpBearerAuth::className(),
                ],
                'paramAuth' => [
                    'class' => QueryParamAuth::className(),
                    'tokenParam' => 'auth_key', // This value can be changed to its own, for example hash
                ],
                'basicAuth' => [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password) {
                        return $this->processBasicAuth($username, $password);
                    }
                ],
            ]
        ];
        return $behaviors;
    }

    /**
     * @param string $username
     * @param string $password
     * @return User|null|array
     */
    protected function processBasicAuth($username, $password)
    {
        /** @var User $modelClass */
        $modelClass = $this->modelClass;
        /** @var User $user */
        if ($user = $modelClass::find()->where(['username' => $username])->one()) {
            return $user->validatePassword($password) ? $user : null;
        }
        return null;
    }
}
