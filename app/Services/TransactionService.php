<?php

namespace App\Services;

use App\Contracts\Repositories\TransactionRepositoryContract;
use App\Contracts\Services\TransactionServiceContract;

class TransactionService extends BaseService implements TransactionServiceContract {

    /**
     * @param TransactionRepositoryContract $repository
     */
    public function __construct(TransactionRepositoryContract $repository) {
        parent::__construct($repository);
    }
}
