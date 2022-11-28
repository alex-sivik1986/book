<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m221122_151852_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'surname' => $this->string(32)->notNull(),
            'phone' => $this->string(32),
            'birthday' => $this->date(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author}}');
    }
}
