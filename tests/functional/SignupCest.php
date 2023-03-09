<?php

class SignupCest {
    public function _fixtures() {
        return [
            'User' => [
                'class' => \app\tests\fixtures\UserFixture::class,
                'dataFile' => '@app/tests/fixtures/_data/user.php',
            ],
        ];
    }

    public function _before(\FunctionalTester $I) {
        $I->amOnRoute('/site/signup');
    }

    public function openSignupPage(\FunctionalTester $I) {
        $I->see(Yii::$app->params['siteName'], 'h1');

    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginById(\FunctionalTester $I) {
        $I->amLoggedInAs(1);
        $I->amOnPage('/');
        $I->see('Logout (admin)');
        $I->click('Logout (admin)');
    }

    public function signupWithEmptyCredentials(\FunctionalTester $I) {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function signupWithBadPassword(\FunctionalTester $I) {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => '',
            'LoginForm[confirmPassword]' => '',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Password cannot be blank.');

        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'pass',
            'LoginForm[confirmPassword]' => '',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Passwords do not match.');

        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'pass',
            'LoginForm[confirmPassword]' => 'pass',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Password Password must be 8 characters long');

        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'password',
            'LoginForm[confirmPassword]' => 'password',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Password Password must contain a digit');
    }

    public function signupSuccessfully(\FunctionalTester $I) {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'testuser',
            'LoginForm[password]' => 'testuser1',
            'LoginForm[confirmPassword]' => 'testuser1',
        ]);
        $I->see('Logout (testuser)');
        $I->dontSeeElement('form#login-form');
        $I->amOnRoute('/site/login');

        $I->click('Logout (testuser)');

        $user = \app\models\User::findByUsername('testuser');
        $user->delete();
    }
}