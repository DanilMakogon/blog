<?php


namespace app\models;


class SignupForm extends \yii\base\Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Введите имя пользователя'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такое логин уже занят.'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Короткое имя'],
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Введите почту'],
            ['email', 'email', 'message' => 'Неверное значение почты'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Такая почта уже занята.'],
            ['password', 'required', 'message' => 'Введите пароль'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'Пароль должен содержать не менее 6-ти символов'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'email' => 'Почта',
            'auth_key' => 'Ключ аутентификации',
            'status' => 'Статус',
            'role' => 'Роль',
            'created_at' => 'Время создания',
            'updated_at' => 'Время обновления'
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}