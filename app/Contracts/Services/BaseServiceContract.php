<?php

namespace App\Contracts\Services;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseServiceContract {

    /**
     * @param array $conditions
     * @return bool
     */
    public function exists(array $conditions = []): bool;

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model;

    /**
     * @param array $conditions
     * @return Model|null
     */
    public function findByCondition(array $conditions = []): ?Model;

    /**
     * @return Collection
     */
    public function get(): Collection;

    /**
     * @param int $perPage
     * @return Paginator
     */
    public function paginate(int $perPage = 12): Paginator;

    /**
     * @param array $conditions
     * @param array $payload
     * @return Model
     */
    public function firstOrCreate(array $conditions, array $payload): Model;
}
