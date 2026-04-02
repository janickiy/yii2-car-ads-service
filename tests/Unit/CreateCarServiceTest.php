<?php

declare(strict_types=1);

namespace tests\Unit;

use app\application\DTO\CreateCarRequest;
use app\application\Service\CreateCarService;
use app\domain\Entity\Car;
use app\domain\Entity\CarOption;
use app\domain\Repository\CarRepositoryInterface;
use PHPUnit\Framework\TestCase;

final class CreateCarServiceTest extends TestCase
{
    public function testCreatesCarAdWithOptions(): void
    {
        $repository = new class implements CarRepositoryInterface {
            public ?Car $saved = null;

            public function save(Car $car): Car
            {
                $this->saved = $car;
                return $car->withIdAndCreatedAt(1, '2026-04-02 10:00:00');
            }

            public function findById(int $id): ?Car
            {
                return null;
            }

            public function paginate(int $page, int $perPage): array
            {
                return [];
            }

            public function countAll(): int
            {
                return 0;
            }
        };

        $service = new CreateCarService($repository);
        $dto = CreateCarRequest::fromArray([
            'title' => 'BMW X5',
            'description' => 'Отличное состояние',
            'price' => 25000,
            'photo_url' => 'https://example.com/bmw.jpg',
            'contacts' => '+70000000000',
            'options' => [
                'brand' => 'BMW',
                'model' => 'X5',
                'year' => 2021,
                'body' => 'SUV',
                'mileage' => 50000,
            ],
        ]);

        $car = $service->handle($dto);

        self::assertSame(1, $car->id);
        self::assertSame('BMW X5', $car->title);
        self::assertSame('25000.00', $repository->saved->price);
        self::assertInstanceOf(CarOption::class, $repository->saved->options);
        self::assertSame('BMW', $repository->saved->options->brand);
    }
}
