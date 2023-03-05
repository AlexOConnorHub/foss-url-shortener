<?php

namespace app\models;

use Yii;
use app\models\Visit;

/**
 * This is the model class for table "shortened".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $edit_uuid
 * @property string $redirect_uuid
 * @property string $redirect_url
 *
 * @property User $user
 * @property Visit[] $visits
 */
class Shortened extends \yii\db\ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'shortened';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['user_id'], 'default', 'value' => Yii::$app->user->id ?? null],
            [['edit_uuid'], 'default', 'value' => $this->getUniqueUuid("edit_uuid")],
            [['redirect_uuid'], 'default', 'value' => $this->getUniqueUuid("redirect_uuid")],
            [['user_id'], 'integer'],
            [['edit_uuid', 'redirect_uuid', 'redirect_url'], 'required'],
            [['edit_uuid', 'redirect_uuid'], 'string', 'max' => Yii::$app->params['uuidLength']],
            [['redirect_url'], 'string', 'max' => 255],
            [['edit_uuid', 'redirect_uuid'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['redirect_url'], 'url', 'defaultScheme' => 'http'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'edit_uuid' => 'Edit UUID',
            'redirect_uuid' => 'Redirect UUID',
            'redirect_url' => 'Redirect Url',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser() {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Visit]].
     *
     * @return \yii\db\ActiveQuery|VisitQuery
     */
    public function getVisit() {
        return $this->hasOne(Visit::class, ['id' => 'visit_id']);
    }

    /**
     * Gets query for [[Visits]].
     *
     * @return \yii\db\ActiveQuery|VisitQuery
     */
    public function getVisits() {
        return $this->hasMany(Visit::class, ['shortened_id' => 'id']);
    }

    /**
     * Get full URL
     * @return string
     */
    public function getUrl() {
        // Use a helper to get the base URL
        $base = Yii::$app->request->hostInfo;
        return $base . '/r/' . $this->redirect_uuid;
    }

    /**
     * Get unique edit UUID
     * @param string $field Field to check for uniqueness
     * @return string
     */
    public function getUniqueUuid($field) {
        for ($i = 0; $i < 10; $i++) {
            $uuid = Yii::$app->security->generateRandomString(Yii::$app->params['uuidLength']);
            if (!Shortened::find()->where([$field => $uuid])->exists()) {
                return $uuid;
            }
            Yii::warning('Generated UUID ' . $uuid . ' already exists for ' . $field . ' (attempt ' . $i . ' of 10)');
        }
        Yii::error('Unable to generate unique UUID for ' . $field);
        return false;
    }
}
