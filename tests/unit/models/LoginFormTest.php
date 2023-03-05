<?php

namespace tests\unit\models;

use app\models\LoginForm;
use Yii;

class LoginFormTest extends \Codeception\Test\Unit {
    private $model;
    
    public function _fixtures() {
        return [
            'User' => [
                'class' => \app\tests\fixtures\UserFixture::class,
                'dataFile' => '@app/tests/fixtures/_data/user.php',
            ],
        ];
    }

    protected function _after() {
        Yii::$app->user->logout();
    }

    public function testLoginNoUser() {
        $this->model = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        verify($this->model->login())->false();
        verify(Yii::$app->user->isGuest)->true();
    }

    public function testLoginWrongPassword() {
        $this->model = new LoginForm([
            'username' => 'demo',
            'password' => 'wrong_password',
        ]);

        verify($this->model->login())->false();
        verify(Yii::$app->user->isGuest)->true();
        verify($this->model->errors)->arrayHasKey('password');
    }

    public function testLoginCorrect() {
        $this->model = new LoginForm([
            'username' => 'admin',
            'password' => 'admin',
        ]);

        verify($this->model->login())->true();
        verify(Yii::$app->user->isGuest)->false();
        verify($this->model->errors)->arrayHasNotKey('password');
    }

}
