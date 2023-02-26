<?php

use yii\db\Migration;

/**
 * Class m230226_080809_init
 */
class m230226_080809_init extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        /**
         * table: users
         * columns:
         * id PK
         * username string
         * password string
         * created_at timestamp
         * auth_key string
         * access_token string
         */
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'auth_key' => $this->string(),
            'access_token' => $this->string(),
        ]);
        echo "Adding admin user...";
        $this->insert('users', [
            'username' => 'admin',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'created_at' => date('Y-m-d H:i:s'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'access_token' => Yii::$app->security->generateRandomString(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('users');
    }
}
