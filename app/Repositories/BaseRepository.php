<?php

namespace App\Repositories;

use AllowDynamicProperties;
use App\Contracts\Repositories\BaseRepositoryContract;
use App\Enum\FieldEnum;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

#[AllowDynamicProperties] abstract class BaseRepository implements BaseRepositoryContract {

    /**
     * @param Model $model
     */
    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @param array $conditions
     * @return bool
     */
    public function exists(array $conditions = []): bool {
        $query = $this->model->newQuery()->where($conditions);
        return $query->exists();
    }

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model {
        return $this->model->newQuery()->where(FieldEnum::id->value, '=', $id)->firstOrFail();
    }

    /**
     * @param array $conditions
     * @return Model|null
     */
    public function findByCondition(
        array $conditions = [],
    ): ?Model {
        return $this->model->newQuery()->where($conditions)->first();
    }

    /**
     * @param int $perPage
     * @return Paginator
     */
    public function paginate(
        int $perPage = 12,
    ): Paginator {
        return $this->model->newQuery()->paginate($perPage);
    }

    /**
     * @return Collection
     */
    public function get(): Collection {
        return $this->model->newQuery()->get();
    }

    /**
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): Model {
        return $this->model->newQuery()->create($payload);
    }

    /**
     * @param array $conditions
     * @param array $payload
     * @return bool
     */
    public function update(array $conditions, array $payload): bool {
        return (bool)$this->model->newQuery()->where($conditions)->update($payload);
    }

    /**
     * @param array $conditions
     * @param array $payload
     * @return Model
     */
    public function firstOrCreate(array $conditions, array $payload): Model {
        return $this->model->newQuery()->firstOrCreate($conditions, $payload);
    }
}
