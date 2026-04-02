<?php

declare(strict_types=1);

use yii\db\Migration;

final class m240101_000001_create_user_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string()->null(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('NOW()'),
        ]);

        $security = \Yii::$app->security;
        $this->insert('{{%user}}', [
            'username' => 'admin',
            'password_hash' => $security->generatePasswordHash('1234567'),
            'auth_key' => bin2hex(random_bytes(16)),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%user}}');
    }
}
