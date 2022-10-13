<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m221011_195850_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'subject' => $this->string(30)->notNull(),
            'subject_id' => $this->integer(11)->notNull(),
            'username' => $this->string(255)->defaultValue('guest'),
            'comment' => $this->text()->notNull(),
            'ip' => $this->string(15),
            'user_agent' => $this->string(255),
            'status' => $this->integer(2),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
