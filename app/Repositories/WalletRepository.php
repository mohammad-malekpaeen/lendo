<?php

namespace App\Repositories;

use App\Contracts\Repositories\WalletRepositoryContract;
use App\Models\Wallet;
use App\Repositories\BaseRepository;

final class WalletRepository extends BaseRepository implements WalletRepositoryContract {

	public function __construct(Wallet $model) {
		parent::__construct($model);
	}
}
