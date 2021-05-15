<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m210515_082310_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'note_id' => $this->integer(),
            'comment_id' => $this->integer(),
            'is_reply' => $this->boolean(),
            'is_approved' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'note-id',  // это "условное имя" ключа
            'comments', // это название текущей таблицы
            'note_id', // это имя поля в текущей таблице, которое будет ключом
            'notes', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE' // после удаления записи, все комменты этой записи удалятся
        );

        $this->addForeignKey(
            'parent-comment-id',  // это "условное имя" ключа
            'comments', // это название текущей таблицы
            'comment_id', // это имя поля в текущей таблице, которое будет ключом
            'comments', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE' // после удаления родительского коммента, все дочерние удалятся
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comments}}');
    }
}
