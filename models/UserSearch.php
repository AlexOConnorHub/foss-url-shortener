<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserDB]].
 *
 * @see UserDB
 */
class UserSearch extends \yii\db\ActiveQuery {
    /*public function active() {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserDB[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserDB|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }
}
