<?php

declare(strict_types=1);

namespace app\domain\Entity;

final class Car
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $title,
        public readonly string $description,
        public readonly string $price,
        public readonly string $photoUrl,
        public readonly string $contacts,
        public readonly ?string $createdAt,
        public readonly ?CarOption $options = null,
    ) {
    }

    public function withIdAndCreatedAt(int $id, string $createdAt): self
    {
        return new self(
            id: $id,
            title: $this->title,
            description: $this->description,
            price: $this->price,
            photoUrl: $this->photoUrl,
            contacts: $this->contacts,
            createdAt: $createdAt,
            options: $this->options,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => (float)$this->price,
            'photo_url' => $this->photoUrl,
            'contacts' => $this->contacts,
            'created_at' => $this->createdAt,
            'options' => $this->options?->toArray(),
        ];
    }
}
