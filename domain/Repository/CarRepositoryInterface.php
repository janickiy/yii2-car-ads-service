<?php

declare(strict_types=1);

namespace app\domain\Repository;

use app\domain\Entity\Car;

interface CarRepositoryInterface
{
    public function save(Car $car): Car;

    public function findById(int $id): ?Car;

    /** @return Car[] */
    public function paginate(int $page, int $perPage): array;

    public function countAll(): int;
}
