<?php

namespace app\models;

use Yii;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 * @property int $category_id
 * @property int $creator_id
 * @property boolean $is_hidden
 *
 * @property Comment[] $comments
 * @property NoteCategory $category
 * @property Note $note
 * @property User $creator
 */
class Note extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'category_id', 'creator_id'], 'required'],
            [['content'], 'string'],
            [['created_at', 'updated_at', 'category_id', 'creator_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [
                ['category_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => NoteCategory::className(),
                'targetAttribute' => ['category_id' => 'id']
            ],
            [
                ['creator_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['creator_id' => 'id']
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->created_at == null) {
            $this->created_at = time();
            $this->updated_at = $this->created_at;
        } else {
            $this->updated_at = time();
        }

        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'content' => 'Контент',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
            'category_id' => 'Категория',
            'creator_id' => 'Автор'
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['note_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(NoteCategory::className(), ['id' => 'category_id']);
    }


    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return string
     */
    public function getCreatorName()
    {
        return User::findOne($this->creator_id)->username;
    }

    /**
     * @return string
     */
    public function getCategoryName()
    {
        return NoteCategory::findOne($this->category_id)->name;
    }

    public function getDatetime()
    {
        return Yii::$app->formatter->asDate($this->created_at, 'y-MM-d h:i:s');
    }

    public function getShortedContent()
    {
        return StringHelper::truncateWords($this->content, 40, '...');
    }
}
