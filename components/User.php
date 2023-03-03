<?php

namespace app\components;

use Yii;

class User extends \yii\web\User {
    public function getIsAdmin() {
        return $this->identity->isAdmin;
    }

    public function getUsername() {
        return $this->identity->username;
    }
}