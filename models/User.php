<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $created_at
 * @property string|null $auth_key
 * @property string|null $access_token
 *
 * @property Shortened[] $shorteneds
 * @property Visits[] $visits
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['username', 'password'], 'required'],
            [['created_at'], 'safe'],
            [['username', 'password', 'auth_key', 'access_token'], 'string', 'max' => 255],
            [['username'], 'match', 'pattern' => '/^[a-zA-Z0-9_]+$/', 'message' => 'Username can only contain alphanumeric characters and underscores'],
            [['username'], 'unique'],
            [['password'], 'match', 'pattern' => '/^.{8,}$/', 'message' => 'Password must be 8 characters long'],
            [['password'], 'match', 'pattern' => '/\d/', 'message' => 'Password must contain a digit'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'created_at' => 'Created At',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
                $this->access_token = Yii::$app->security->generateRandomString();
                $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

    /**
     * Gets query for [[Shorteneds]].
     *
     * @return \yii\db\ActiveQuery|ShortenedrSearch
     */
    public function getShorteneds() {
        return $this->hasMany(Shortened::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Visits]].
     *
     * @return \yii\db\ActiveQuery|VisitsQuery
     */
    public function getVisits() {
        return $this->hasMany(Visits::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        return static::findOne($id);;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /**
     * Returns true if user is admin
     * @return bool
     */
    public function getIsAdmin() {
        return $this->username === 'admin';
    }
}
