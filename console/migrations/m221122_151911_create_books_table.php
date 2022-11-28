<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%author}}`
 */
class m221122_151911_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'description' => $this->string(64),
            'author_id' => $this->integer(6)->notNull(),
            'release' => $this->date(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-books-author_id}}',
            '{{%books}}',
            'author_id'
        );

        // add foreign key for table `{{%author}}`
        $this->addForeignKey(
            '{{%fk-books-author_id}}',
            '{{%books}}',
            'author_id',
            '{{%author}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%author}}`
        $this->dropForeignKey(
            '{{%fk-books-author_id}}',
            '{{%books}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-books-author_id}}',
            '{{%books}}'
        );

        $this->dropTable('{{%books}}');
    }
}
