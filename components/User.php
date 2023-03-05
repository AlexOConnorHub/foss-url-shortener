<?php

namespace app\components;

use Yii;

class User extends \yii\web\User {
    public function getIsAdmin() {
        if ($this->isGuest) {
            return false;
        }
        return $this->identity->isAdmin;
    }

    public function getUsername() {
        if ($this->isGuest) {
            return null;
        }
        return $this->identity->username;
    }
}