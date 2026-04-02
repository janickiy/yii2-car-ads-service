<?php

declare(strict_types=1);

namespace app\infrastructure\Persistence\ActiveRecord;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class CarOptionRecord extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%car_option}}';
    }

    public function rules(): array
    {
        return [
            [['car_id', 'brand', 'model', 'year', 'body', 'mileage'], 'required'],
            [['car_id', 'year', 'mileage'], 'integer'],
            [['brand', 'model', 'body'], 'string', 'max' => 255],
            [['car_id'], 'exist', 'targetClass' => CarRecord::class, 'targetAttribute' => ['car_id' => 'id']],
        ];
    }

    public function getCar(): ActiveQuery
    {
        return $this->hasOne(CarRecord::class, ['id' => 'car_id']);
    }
}
