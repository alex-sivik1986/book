<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books_janr}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%books}}`
 * - `{{%janr}}`
 */
class m221122_152955_create_junction_table_for_books_and_janr_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books_janr}}', [
            'books_id' => $this->integer(),
            'janr_id' => $this->integer(),
            'PRIMARY KEY(books_id, janr_id)',
        ]);

        // creates index for column `books_id`
        $this->createIndex(
            '{{%idx-books_janr-books_id}}',
            '{{%books_janr}}',
            'books_id'
        );

        // add foreign key for table `{{%books}}`
        $this->addForeignKey(
            '{{%fk-books_janr-books_id}}',
            '{{%books_janr}}',
            'books_id',
            '{{%books}}',
            'id',
            'CASCADE'
        );

        // creates index for column `janr_id`
        $this->createIndex(
            '{{%idx-books_janr-janr_id}}',
            '{{%books_janr}}',
            'janr_id'
        );

        // add foreign key for table `{{%janr}}`
        $this->addForeignKey(
            '{{%fk-books_janr-janr_id}}',
            '{{%books_janr}}',
            'janr_id',
            '{{%janr}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%books}}`
        $this->dropForeignKey(
            '{{%fk-books_janr-books_id}}',
            '{{%books_janr}}'
        );

        // drops index for column `books_id`
        $this->dropIndex(
            '{{%idx-books_janr-books_id}}',
            '{{%books_janr}}'
        );

        // drops foreign key for table `{{%janr}}`
        $this->dropForeignKey(
            '{{%fk-books_janr-janr_id}}',
            '{{%books_janr}}'
        );

        // drops index for column `janr_id`
        $this->dropIndex(
            '{{%idx-books_janr-janr_id}}',
            '{{%books_janr}}'
        );

        $this->dropTable('{{%books_janr}}');
    }
}
