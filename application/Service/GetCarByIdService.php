<?php

declare(strict_types=1);

namespace app\application\Service;

use app\domain\Entity\Car;
use app\domain\Repository\CarRepositoryInterface;

final readonly class GetCarByIdService
{
    public function __construct(private CarRepositoryInterface $carRepository)
    {
    }

    /**
     * @param int $id
     * @return Car|null
     */
    public function handle(int $id): ?Car
    {
        return $this->carRepository->findById($id);
    }
}
