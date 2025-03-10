<?php

namespace App\Contracts\Services;

use App\Dto\Repositories\WalletDto;
use App\Dto\WalletTransactionDto;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Model;

interface WalletServiceContract extends BaseServiceContract {

    /**
     * @param WalletDto $dto
     * @return Model|Wallet
     */
    public function create(WalletDto $dto): Model|Wallet;

    /**
     * @param int $userId
     * @return int
     */
    public function getBalance(int $userId): int;

    public function getUserWalletId(int $userId): int;

    /**
     * @param WalletTransactionDto $dto
     * @return Model|Transaction
     */
    public function change(WalletTransactionDto $dto): Model|Transaction;

}
