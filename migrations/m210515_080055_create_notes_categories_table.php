<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notes_categories}}`.
 */
class m210515_080055_create_notes_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notes_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'is_hidden' => $this->boolean()->defaultValue(false)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notes_categories}}');
    }
}
