<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notes_categories".
 *
 * @property int $id
 * @property string $name
 * @property int $is_hidden
 *
 * @property Note[] $notes
 */
class NoteCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_hidden'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'is_hidden' => 'Is Hidden',
        ];
    }

    /**
     * Gets query for [[Notes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Note::className(), ['category_id' => 'id']);
    }
}
