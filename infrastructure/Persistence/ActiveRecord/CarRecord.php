<?php

declare(strict_types=1);

namespace app\infrastructure\Persistence\ActiveRecord;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class CarRecord extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%car}}';
    }

    public function rules(): array
    {
        return [
            [['title', 'description', 'price', 'photo_url', 'contacts'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['created_at'], 'safe'],
            [['title', 'photo_url', 'contacts'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'price' => 'Цена',
            'photo_url' => 'Ссылка на фото',
            'contacts' => 'Контакты',
            'created_at' => 'Дата создания',
        ];
    }

    public function getOption(): ActiveQuery
    {
        return $this->hasOne(CarOptionRecord::class, ['car_id' => 'id']);
    }
}
