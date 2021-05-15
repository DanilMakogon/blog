<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $text
 * @property int|null $note_id
 * @property int|null $comment_id
 * @property int|null $is_reply
 * @property int|null $is_approved
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Note $note
 * @property Comment $comment
 * @property Comment[] $comments
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'created_at', 'updated_at'], 'required'],
            [['text'], 'string'],
            [['note_id', 'comment_id', 'is_reply', 'is_approved', 'created_at', 'updated_at'], 'integer'],
            [['note_id'], 'exist', 'skipOnError' => true, 'targetClass' => Note::className(), 'targetAttribute' => ['note_id' => 'id']],
            [['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['comment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'note_id' => 'Note ID',
            'comment_id' => 'Comment ID',
            'is_reply' => 'Is Reply',
            'is_approved' => 'Is Approved',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Note]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNote()
    {
        return $this->hasOne(Note::className(), ['id' => 'note_id']);
    }

    /**
     * Gets query for [[Comment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasOne(Comment::className(), ['id' => 'comment_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['comment_id' => 'id']);
    }
}
