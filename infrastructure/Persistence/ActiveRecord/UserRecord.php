<?php

declare(strict_types=1);

namespace app\infrastructure\Persistence\ActiveRecord;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class UserRecord extends ActiveRecord implements IdentityInterface
{
    public string $plain_password = '';

    public static function tableName(): string
    {
        return '{{%user}}';
    }

    public function rules(): array
    {
        return [
            [['username'], 'required'],
            [['created_at'], 'safe'],
            [['username', 'password_hash', 'auth_key', 'plain_password'], 'string', 'max' => 255],
            [['username'], 'unique'],
            ['plain_password', 'required', 'on' => 'create'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'password_hash' => 'Хэш пароля',
            'plain_password' => 'Пароль',
            'auth_key' => 'Ключ авторизации',
            'created_at' => 'Дата создания',
        ];
    }

    public function beforeValidate(): bool
    {
        if ($this->isNewRecord) {
            $this->scenario = 'create';
        }

        return parent::beforeValidate();
    }

    public static function findIdentity($id): ?IdentityInterface
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): ?IdentityInterface
    {
        return null;
    }

    public static function findByUsername(string $username): ?self
    {
        return static::findOne(['username' => $username]);
    }

    public function getId(): int|string
    {
        return $this->id;
    }

    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, (string) $this->password_hash);
    }

    public function setPassword(string $password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}
