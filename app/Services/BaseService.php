<?php

namespace App\Services;

use App\Contracts\Repositories\BaseRepositoryContract;
use App\Contracts\Services\BaseServiceContract;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService implements BaseServiceContract {

    /**
     * @var BaseRepositoryContract
     */
    protected BaseRepositoryContract $repository;

    /**
     * @param BaseRepositoryContract $repository
     */
    public function __construct(BaseRepositoryContract $repository) {
        $this->repository = $repository;
    }

    /**
     * @param array $conditions
     * @return bool
     */
    public function exists(array $conditions = []): bool {
        return $this->repository->exists($conditions);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function findById(int $id): Model {
        return $this->repository->findById(id: $id);
    }

    /**
     * @param array $conditions
     * @return Model|null
     */
    public function findByCondition(array $conditions = []): ?Model {
        return $this->repository->findByCondition(conditions: $conditions);
    }

    /**
     * @return Collection
     */
    public function get(): Collection {
        return $this->repository->get();
    }

    /**
     * @param int $perPage
     * @return Paginator
     */
    public function paginate(int $perPage = 12): Paginator {
        return $this->repository->paginate(perPage: $perPage);
    }

    /**
     * @param array $conditions
     * @param array $payload
     * @return Model
     */
    public function firstOrCreate(array $conditions, array $payload): Model {
        return $this->repository->firstOrCreate($conditions, $payload);
    }

}
