<?php

namespace api\modules\v1\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class User
 * @package api\modules\v1\models
 */
class User extends \modules\users\models\User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), []);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), []);
    }

    /**
     * /api/v1/user
     * @return array
     */
    public function fields()
    {
        return ['id', 'email', 'username', 'first_name', 'last_name'];
    }

    /**
     * /api/v1/users?expand=status
     * @return array
     */
    public function extraFields()
    {
        return ['status', 'created_at', 'updated_at', 'last_visit', 'registration_type'];
    }
}
