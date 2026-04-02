<?php

declare(strict_types=1);

namespace app\application\Service;

use app\domain\Repository\CarRepositoryInterface;

final readonly class ListCarsService
{
    public function __construct(private CarRepositoryInterface $carRepository)
    {
    }

    public function handle(int $page, int $perPage): array
    {
        $page = max($page, 1);
        $items = $this->carRepository->paginate($page, $perPage);
        $total = $this->carRepository->countAll();

        return [
            'items' => array_map(static fn($car) => $car->toArray(), $items),
            'pagination' => [
                'page' => $page,
                'per_page' => $perPage,
                'total' => $total,
                'pages' => (int)ceil($total / $perPage),
            ],
        ];
    }
}
