<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visits".
 *
 * @property int $id
 * @property int|null $shortened_id
 * @property string|null $country_code
 * @property int|null $user_id
 * @property string $ip
 * @property string|null $user_agent
 * @property string|null $accepted_languages
 * @property string $created_at
 * @property string|null $isp
 *
 * @property Shortened $shortened
 * @property Shortened[] $shorteneds
 * @property Users $user
 */
class Visit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shortened_id', 'user_id'], 'integer'],
            [['ip'], 'required'],
            [['created_at'], 'safe'],
            [['country_code', 'ip', 'user_agent', 'accepted_languages', 'isp'], 'string', 'max' => 255],
            [['shortened_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shortened::class, 'targetAttribute' => ['shortened_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shortened_id' => 'Shortened ID',
            'country_code' => 'Country Code',
            'user_id' => 'User ID',
            'ip' => 'Ip',
            'user_agent' => 'User Agent',
            'accepted_languages' => 'Accepted Languages',
            'created_at' => 'Created At',
            'isp' => 'Isp',
        ];
    }

    /**
     * Gets query for [[Shortened]].
     *
     * @return \yii\db\ActiveQuery|ShortenedrSearch
     */
    public function getShortened()
    {
        return $this->hasOne(Shortened::class, ['id' => 'shortened_id']);
    }

    /**
     * Gets query for [[Shorteneds]].
     *
     * @return \yii\db\ActiveQuery|ShortenedrSearch
     */
    public function getShorteneds()
    {
        return $this->hasMany(Shortened::class, ['visit_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return VisitSearch the active query used by this AR class.
     */
    public static function find()
    {
        return new VisitSearch(get_called_class());
    }
}
