<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $adress
 * @property string $number
 * @property string $date
 * @property string $time
 * @property int $id_type
 * @property string $another
 * @property int $id_pay
 * @property int $id_user
 * @property int $id_status
 *
 * @property Pay $pay
 * @property Status $status
 * @property Type $type
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adress', 'number', 'date', 'time', 'id_type', 'id_pay'], 'required'],
            [['id_type', 'id_pay', 'id_user', 'id_status'], 'integer'],
            [['adress', 'number', 'date', 'time'], 'string', 'max' => 50],
            ['another', 'default', 'value' => null],
            ['id_user', 'default', 'value' => Yii::$app->user->identity->getId()],
            ['id_status', 'default', 'value' => 1],
            [['id_pay'], 'exist', 'skipOnError' => true, 'targetClass' => Pay::class, 'targetAttribute' => ['id_pay' => 'id']],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['id_status' => 'id']],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => Type::class, 'targetAttribute' => ['id_type' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'adress' => 'Адрес',
            'number' => 'Номер телефона',
            'date' => 'Дата',
            'time' => 'Время',
            'id_type' => 'Тип услуги',
            'another' => 'Другая услуга',
            'id_pay' => 'Тип оплаты',
            'id_user' => 'Id User',
            'id_status' => 'Id Status',
        ];
    }

    /**
     * Gets query for [[Pay]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPay()
    {
        return $this->hasOne(Pay::class, ['id' => 'id_pay']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'id_status']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::class, ['id' => 'id_type']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}
