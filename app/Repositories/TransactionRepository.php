<?php

namespace App\Repositories;

use App\Contracts\Repositories\TransactionRepositoryContract;
use App\Models\Transaction;

final class TransactionRepository extends BaseRepository implements TransactionRepositoryContract {

    public function __construct(Transaction $model) {
        parent::__construct($model);
    }
}
