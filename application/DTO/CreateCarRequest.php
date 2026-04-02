<?php

declare(strict_types=1);

namespace app\application\DTO;

use app\application\Exception\DomainValidationException;

final class CreateCarRequest
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly float $price,
        public readonly string $photoUrl,
        public readonly string $contacts,
        public readonly ?array $options,
    ) {
    }

    public static function fromArray(array $data): self
    {
        foreach (['title', 'description', 'price', 'photo_url', 'contacts'] as $field) {
            if (!array_key_exists($field, $data)) {
                throw new DomainValidationException(sprintf('Field "%s" is required.', $field));
            }
        }

        if ($data['options'] !== null) {
            foreach (['brand', 'model', 'year', 'body', 'mileage'] as $field) {
                if (!isset($data['options'][$field])) {
                    throw new DomainValidationException(sprintf('Option field "%s" is required.', $field));
                }
            }
        }

        return new self(
            title: trim((string)$data['title']),
            description: trim((string)$data['description']),
            price: (float)$data['price'],
            photoUrl: trim((string)$data['photo_url']),
            contacts: trim((string)$data['contacts']),
            options: $data['options'] ?? null,
        );
    }
}
