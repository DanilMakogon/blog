<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notes}}`.
 */
class m210515_080056_create_notes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notes}}', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull(),
            'content'=>$this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'creator_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'note-creator-id',  // это "условное имя" ключа
            'notes', // это название текущей таблицы
            'creator_id', // это имя поля в текущей таблице, которое будет ключом
            'users', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE' // после удаления пользователя, все его записи удалятся
        );

        $this->addForeignKey(
            'note-category-id',  // это "условное имя" ключа
            'notes', // это название текущей таблицы
            'category_id', // это имя поля в текущей таблице, которое будет ключом
            'notes_categories', // это имя таблицы, с которой хотим связаться
            'id', // это поле таблицы, с которым хотим связаться
            'CASCADE' // после удаления категории,  все записи с этой категорией удалятся
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notes}}');
    }
}
