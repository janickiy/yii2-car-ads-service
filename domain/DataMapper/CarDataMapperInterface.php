<?php

declare(strict_types=1);

namespace app\domain\DataMapper;

use app\domain\Entity\Car;
use app\infrastructure\Persistence\ActiveRecord\CarRecord;

interface CarDataMapperInterface
{
    public function mapToEntity(CarRecord $record): Car;
}
