<?php

declare(strict_types=1);

namespace app\application\Service;

use app\application\DTO\CreateCarRequest;
use app\application\Exception\DomainValidationException;
use app\domain\Entity\Car;
use app\domain\Entity\CarOption;
use app\domain\Repository\CarRepositoryInterface;

final readonly class CreateCarService
{
    public function __construct(private CarRepositoryInterface $carRepository)
    {
    }

    public function handle(CreateCarRequest $request): Car
    {
        if ($request->title === '' || $request->description === '' || $request->photoUrl === '' || $request->contacts === '') {
            throw new DomainValidationException('Required string fields must not be empty.');
        }

        if ($request->price <= 0) {
            throw new DomainValidationException('Price must be greater than zero.');
        }

        $option = null;
        if ($request->options !== null) {
            $option = new CarOption(
                id: null,
                brand: (string)$request->options['brand'],
                model: (string)$request->options['model'],
                year: (int)$request->options['year'],
                body: (string)$request->options['body'],
                mileage: (int)$request->options['mileage'],
            );
        }

        $car = new Car(
            id: null,
            title: $request->title,
            description: $request->description,
            price: number_format($request->price, 2, '.', ''),
            photoUrl: $request->photoUrl,
            contacts: $request->contacts,
            createdAt: null,
            options: $option,
        );

        return $this->carRepository->save($car);
    }
}
