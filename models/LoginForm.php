<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model {
    public $username;
    public $password;
    public $confirmPassword;
    public $rememberMe = true;
    public $isNew = false;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_]+$/', 'message' => 'Username can only contain alphanumeric characters and underscores'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if ($this->confirmPassword !== null) {
            // Regex to check if password is strong enough
            $regex = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/';
            if (!preg_match($regex, $this->password)) {
                $this->addError($attribute, 'Password must be at least 8 characters long and contain at least one number');
                return;
            }
            return;
        }
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
