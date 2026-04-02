<?php

declare(strict_types=1);

namespace app\infrastructure\Persistence\DataMapper;

use app\domain\Entity\Car;
use app\domain\Entity\CarOption;
use app\infrastructure\Persistence\ActiveRecord\CarRecord;

final class CarDataMapper
{
    public function mapToEntity(CarRecord $record): Car
    {
        $option = null;
        if ($record->option !== null) {
            $option = new CarOption(
                id: (int)$record->option->id,
                brand: (string)$record->option->brand,
                model: (string)$record->option->model,
                year: (int)$record->option->year,
                body: (string)$record->option->body,
                mileage: (int)$record->option->mileage,
            );
        }

        return new Car(
            id: (int)$record->id,
            title: (string)$record->title,
            description: (string)$record->description,
            price: (string)$record->price,
            photoUrl: (string)$record->photo_url,
            contacts: (string)$record->contacts,
            createdAt: (string)$record->created_at,
            options: $option,
        );
    }
}
