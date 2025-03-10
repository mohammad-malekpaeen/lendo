<?php

namespace App\Events;

use App\Models\Transaction;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionCreated {

	use Dispatchable, InteractsWithSockets, SerializesModels;

	public Transaction|Model $transaction;

	public function __construct(Transaction|Model $transaction) {
		$this->transaction = $transaction;
	}

	public function broadcastOn(): array {
		return [];
	}

}
