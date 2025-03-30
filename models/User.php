<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $FIO
 * @property string $number
 * @property string $email
 * @property string $role
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $password2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'FIO', 'number', 'email', 'password2'], 'required', 'message' => 'Это поле обязательно'],
            [['username', 'password', 'FIO', 'number', 'email'], 'string', 'max' => 50],
            [['role'], 'string', 'max' => 30],
            ['role', 'default', 'value' => 0],
            ['email', 'email', 'message' => 'Некорректная почта'],
            ['password', 'string', 'min' => 6, 'tooShort' => 'Минимум 6 символов'],
            ['password', 'compare', 'compareAttribute' => 'password2', 'message' => 'Пароли не совпадают'],
            ['username', 'unique', 'message' => 'Такой логин уже существует'],
            ['FIO', 'match', 'pattern' => '/^[А-яЁё -]*$/u','message' => 'ФИО можно ввести только на кириллице']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password' => 'Пароль',
            'password2' => 'Повторение пароля',
            'FIO' => 'ФИО',
            'number' => 'Номер телефона',
            'email' => 'Почта',
            'role' => 'Role',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return User::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return parent::beforeSave($insert);

    }
}
