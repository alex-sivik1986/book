<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%janr}}`.
 */
class m221122_152753_create_janr_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%janr}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%janr}}');
    }
}
