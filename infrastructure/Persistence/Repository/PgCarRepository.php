<?php

declare(strict_types=1);

namespace app\infrastructure\Persistence\Repository;

use app\domain\Entity\Car;
use app\domain\Repository\CarRepositoryInterface;
use app\infrastructure\Persistence\ActiveRecord\CarOptionRecord;
use app\infrastructure\Persistence\ActiveRecord\CarRecord;
use app\infrastructure\Persistence\DataMapper\CarDataMapper;
use yii\db\Exception;

final class PgCarRepository implements CarRepositoryInterface
{
    private CarDataMapper $mapper;

    public function __construct()
    {
        $this->mapper = new CarDataMapper();
    }

    public function save(Car $car): Car
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $record = new CarRecord();
            $record->title = $car->title;
            $record->description = $car->description;
            $record->price = $car->price;
            $record->photo_url = $car->photoUrl;
            $record->contacts = $car->contacts;
            $record->created_at = date('Y-m-d H:i:s');
            $record->save(false);

            if ($car->options !== null) {
                $option = new CarOptionRecord();
                $option->car_id = $record->id;
                $option->brand = $car->options->brand;
                $option->model = $car->options->model;
                $option->year = $car->options->year;
                $option->body = $car->options->body;
                $option->mileage = $car->options->mileage;
                $option->save(false);
            }

            $transaction->commit();

            return $this->findById((int)$record->id);
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw new Exception('Failed to save car ad: ' . $e->getMessage(), 0, $e);
        }
    }

    public function findById(int $id): ?Car
    {
        $record = CarRecord::find()->with('option')->where(['id' => $id])->one();
        return $record ? $this->mapper->mapToEntity($record) : null;
    }

    public function paginate(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $records = CarRecord::find()
            ->with('option')
            ->orderBy(['id' => SORT_DESC])
            ->offset($offset)
            ->limit($perPage)
            ->all();

        return array_map(fn(CarRecord $record) => $this->mapper->mapToEntity($record), $records);
    }

    public function countAll(): int
    {
        return (int)CarRecord::find()->count();
    }
}
