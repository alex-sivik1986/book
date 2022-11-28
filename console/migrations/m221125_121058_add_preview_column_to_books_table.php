<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%books}}`.
 */
class m221125_121058_add_preview_column_to_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%books}}', 'preview', $this->text()->after('description'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%books}}', 'preview');
    }
}
