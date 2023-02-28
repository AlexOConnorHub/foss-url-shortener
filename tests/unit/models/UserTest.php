<?php

namespace tests\unit\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit {
    public function _fixtures() {
        return [
            'Users' => [
                'class' => \app\tests\fixtures\UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
        ];
    }

    public function testFindUserById() {
        verify($user = User::findIdentity(1))->notEmpty();
        verify($user->username)->equals('admin');

        verify(User::findIdentity(999))->empty();
    }

    public function testFindUserByUsername() {
        verify($user = User::findByUsername('admin'))->notEmpty();
        verify(User::findByUsername('not-admin'))->empty();
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser() {
        $user = User::findByUsername('admin');

        verify($user->validatePassword('admin'))->notEmpty();
        verify($user->validatePassword('123456'))->empty();        
    }

}
