<?php


namespace app\models;


use yii\base\Model;

class Blog extends Model
{
    public int $offset;
    public int $count;
    public function __construct(int $offset, int $count, $config = [])
    {
        $this->setOffset($offset);
        $this->setCount($count);
        parent::__construct($config);
    }

    public function getNotes()
    {
        return Note::find()->where(['<', 'id', $this->getOffset()])->orderBy("id DESC")->limit($this->getCount())->all();
    }


    public function getOffset(): int
    {
        return $this->offset;
    }


    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }


    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

}