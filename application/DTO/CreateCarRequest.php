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

        $normalizedOptions = null;
        if (array_key_exists('options', $data) && $data['options'] !== null) {
            $options = $data['options'];

            if (is_array($options) && array_is_list($options)) {
                if ($options === []) {
                    throw new DomainValidationException('Field "options" must contain one object or be null.');
                }
                $options = $options[0];
            }

            if (!is_array($options)) {
                throw new DomainValidationException('Field "options" must be an object, an array with one object, or null.');
            }

            foreach (['brand', 'model', 'year', 'body', 'mileage'] as $field) {
                if (!array_key_exists($field, $options)) {
                    throw new DomainValidationException(sprintf('Option field "%s" is required.', $field));
                }
            }

            $normalizedOptions = [
                'brand' => trim((string) $options['brand']),
                'model' => trim((string) $options['model']),
                'year' => (int) $options['year'],
                'body' => trim((string) $options['body']),
                'mileage' => (int) $options['mileage'],
            ];
        }

        return new self(
            title: trim((string) $data['title']),
            description: trim((string) $data['description']),
            price: (float) $data['price'],
            photoUrl: trim((string) $data['photo_url']),
            contacts: trim((string) $data['contacts']),
            options: $normalizedOptions,
        );
    }
}
