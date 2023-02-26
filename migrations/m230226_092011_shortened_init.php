<?php

use yii\db\Migration;

/**
 * Class m230226_092011_shortened_init
 */
class m230226_092011_shortened_init extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        /**
         * table: shortened
         * columns:
         * id PK
         * user_id FK
         * visit_id FK
         * edit_uuid string
         * redirect_uuid string
         * rediret_url string
         */
        $this->createTable('shortened', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'visit_id' => $this->integer(),
            'edit_uuid' => $this->string()->notNull(),
            'redirect_uuid' => $this->string()->notNull(),
            'redirect_url' => $this->string()->notNull(),
        ]);

        /**
         * table: visits
         * columns:
         * id PK
         * shortened_id FK
         * country_code string
         * user_id FK
         * ip string
         * user_agent string
         * accepted_languages string
         * created_at timestamp
         * isp: string
         */
        $this->createTable('visits', [
            'id' => $this->primaryKey(),
            'shortened_id' => $this->integer(),
            'country_code' => $this->string(),
            'user_id' => $this->integer(),
            'ip' => $this->string()->notNull(),
            'user_agent' => $this->string(),
            'accepted_languages' => $this->string(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'isp' => $this->string(),
        ]);

        // add foreign keys
        $this->addForeignKey('fk-shortened-user_id', 'shortened', 'user_id', 'users', 'id', 'SET NULL');
        $this->addForeignKey('fk-shortened-visit_id', 'shortened', 'visit_id', 'visits', 'id', 'SET NULL');
        $this->addForeignKey('fk-visits-shortened_id', 'visits', 'shortened_id', 'shortened', 'id', 'SET NULL');
        $this->addForeignKey('fk-visits-user_id', 'visits', 'user_id', 'users', 'id', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey('fk-shortened-user_id', 'shortened');
        $this->dropForeignKey('fk-shortened-visit_id', 'shortened');
        $this->dropForeignKey('fk-visits-shortened_id', 'visits');
        $this->dropForeignKey('fk-visits-user_id', 'visits');

        $this->dropTable('shortened');
        $this->dropTable('visits');
    }
}
