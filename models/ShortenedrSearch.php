<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Shortened]].
 *
 * @see Shortened
 */
class ShortenedrSearch extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Shortened[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Shortened|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
