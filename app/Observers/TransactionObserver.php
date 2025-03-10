<?php

namespace App\Observers;

use App\Events\TransactionCreated;
use Illuminate\Database\Eloquent\Model;

class TransactionObserver {

	public function __construct() {}

    /**
     * @param Model $model
     * @return void
     */
	public function created(Model $model): void {
		event(new TransactionCreated($model));
	}
}

