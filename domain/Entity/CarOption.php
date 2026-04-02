<?php

declare(strict_types=1);

namespace app\domain\Entity;

final class CarOption
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $brand,
        public readonly string $model,
        public readonly int $year,
        public readonly string $body,
        public readonly int $mileage,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'brand' => $this->brand,
            'model' => $this->model,
            'year' => $this->year,
            'body' => $this->body,
            'mileage' => $this->mileage,
        ];
    }
}
