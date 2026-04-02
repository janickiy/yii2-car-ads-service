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

    public function getOption(): ActiveQuery
    {
        return $this->hasOne(CarOptionRecord::class, ['car_id' => 'id']);
    }
}
