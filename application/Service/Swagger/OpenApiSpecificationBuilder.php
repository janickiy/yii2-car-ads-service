<?php

declare(strict_types=1);

namespace app\application\Service\Swagger;

final class OpenApiSpecificationBuilder
{
    public function build(): array
    {
        return [
            'openapi' => '3.0.3',
            'info' => [
                'title' => 'Car Ads Service API',
                'version' => '1.0.0',
                'description' => 'REST API для управления объявлениями автомобилей.',
            ],
            'servers' => [
                ['url' => 'http://localhost'],
            ],
            'paths' => [
                '/api/v1/car/create' => [
                    'post' => [
                        'summary' => 'Создать объявление',
                        'requestBody' => [
                            'required' => true,
                            'content' => [
                                'application/json' => [
                                    'schema' => [
                                        '$ref' => '#/components/schemas/CreateCarRequest',
                                    ],
                                ],
                            ],
                        ],
                        'responses' => [
                            '201' => [
                                'description' => 'Объявление создано',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            '$ref' => '#/components/schemas/Car',
                                        ],
                                    ],
                                ],
                            ],
                            '400' => [
                                'description' => 'Ошибка валидации',
                            ],
                        ],
                    ],
                ],
                '/api/v1/car/{id}' => [
                    'get' => [
                        'summary' => 'Получить объявление по ID',
                        'parameters' => [
                            [
                                'name' => 'id',
                                'in' => 'path',
                                'required' => true,
                                'schema' => ['type' => 'integer'],
                            ],
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'Объявление найдено',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            '$ref' => '#/components/schemas/Car',
                                        ],
                                    ],
                                ],
                            ],
                            '404' => [
                                'description' => 'Объявление не найдено',
                            ],
                        ],
                    ],
                ],
                '/api/v1/car/list' => [
                    'get' => [
                        'summary' => 'Список объявлений',
                        'parameters' => [
                            [
                                'name' => 'page',
                                'in' => 'query',
                                'required' => false,
                                'schema' => ['type' => 'integer', 'default' => 1],
                            ],
                        ],
                        'responses' => [
                            '200' => [
                                'description' => 'Список объявлений',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            '$ref' => '#/components/schemas/CarListResponse',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'components' => [
                'schemas' => [
                    'CreateCarRequest' => [
                        'type' => 'object',
                        'required' => ['title', 'description', 'price', 'photo_url', 'contacts'],
                        'properties' => [
                            'title' => ['type' => 'string'],
                            'description' => ['type' => 'string'],
                            'price' => ['type' => 'number', 'format' => 'float'],
                            'photo_url' => ['type' => 'string'],
                            'contacts' => ['type' => 'string'],
                            'options' => [
                                'type' => 'array',
                                'nullable' => true,
                                'maxItems' => 1,
                                'items' => [
                                    '$ref' => '#/components/schemas/CarOption',
                                ],
                            ],
                        ],
                    ],
                    'CarOption' => [
                        'type' => 'object',
                        'required' => ['brand', 'model', 'year', 'body', 'mileage'],
                        'properties' => [
                            'id' => ['type' => 'integer', 'nullable' => true],
                            'brand' => ['type' => 'string'],
                            'model' => ['type' => 'string'],
                            'year' => ['type' => 'integer'],
                            'body' => ['type' => 'string'],
                            'mileage' => ['type' => 'integer'],
                        ],
                    ],
                    'Car' => [
                        'type' => 'object',
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'title' => ['type' => 'string'],
                            'description' => ['type' => 'string'],
                            'price' => ['type' => 'number', 'format' => 'float'],
                            'photo_url' => ['type' => 'string'],
                            'contacts' => ['type' => 'string'],
                            'created_at' => ['type' => 'string', 'nullable' => true],
                            'options' => [
                                'type' => 'array',
                                'nullable' => true,
                                'maxItems' => 1,
                                'items' => [
                                    '$ref' => '#/components/schemas/CarOption',
                                ],
                            ],
                        ],
                    ],
                    'CarListResponse' => [
                        'type' => 'object',
                        'properties' => [
                            'items' => [
                                'type' => 'array',
                                'items' => [
                                    '$ref' => '#/components/schemas/Car',
                                ],
                            ],
                            'pagination' => [
                                'type' => 'object',
                                'properties' => [
                                    'page' => ['type' => 'integer'],
                                    'per_page' => ['type' => 'integer'],
                                    'total' => ['type' => 'integer'],
                                    'pages' => ['type' => 'integer'],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
