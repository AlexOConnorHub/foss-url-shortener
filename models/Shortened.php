<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shortened".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $visit_id
 * @property string $edit_uuid
 * @property string $redirect_uuid
 * @property string $redirect_url
 *
 * @property User $user
 * @property Visit $visit
 * @property Visit[] $visits
 */
class Shortened extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shortened';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'visit_id'], 'integer'],
            [['edit_uuid', 'redirect_uuid', 'redirect_url'], 'required'],
            [['edit_uuid', 'redirect_uuid', 'redirect_url'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['visit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Visit::class, 'targetAttribute' => ['visit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'visit_id' => 'Visit ID',
            'edit_uuid' => 'Edit Uuid',
            'redirect_uuid' => 'Redirect Uuid',
            'redirect_url' => 'Redirect Url',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Visit]].
     *
     * @return \yii\db\ActiveQuery|VisitQuery
     */
    public function getVisit()
    {
        return $this->hasOne(Visit::class, ['id' => 'visit_id']);
    }

    /**
     * Gets query for [[Visits]].
     *
     * @return \yii\db\ActiveQuery|VisitQuery
     */
    public function getVisits()
    {
        return $this->hasMany(Visit::class, ['shortened_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ShortenedrSearch the active query used by this AR class.
     */
    public static function find()
    {
        return new ShortenedrSearch(get_called_class());
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
}
