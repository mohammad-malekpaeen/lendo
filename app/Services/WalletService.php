<?php

namespace App\Services;

use App\Contracts\Repositories\TransactionRepositoryContract;
use App\Contracts\Repositories\WalletRepositoryContract;
use App\Contracts\Services\WalletServiceContract;
use App\Dto\Repositories\TransactionDto;
use App\Dto\Repositories\WalletDto;
use App\Dto\WalletTransactionDto;
use App\Enum\DocumentType;
use App\Enum\FieldEnum;
use App\Exceptions\WalletBalanceNotEnoughException;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class WalletService extends BaseService implements WalletServiceContract {

    /**
     * @param TransactionRepositoryContract $repository
     * @param WalletRepositoryContract $walletRepository
     */
    public function __construct(
        TransactionRepositoryContract $repository,
        protected WalletRepositoryContract $walletRepository,
    ) {
        parent::__construct($repository);
    }

    /**
     * @throws Throwable
     */
    public function change(WalletTransactionDto $dto): Model|Transaction {
        if ($dto->isIncome() == false) {
            $balance = $this->getBalance($dto->getUserId());
            throw_if($balance <= $dto->getAmount(), WalletBalanceNotEnoughException::class);
        }

        return $this->makeTransaction(
            new TransactionDto(
                walletId: $this->getUserWalletId($dto->getUserId()),
                type: !empty($dto->getType()) ? $dto->getType() : DocumentType::WALLET,
                isIncome: $dto->isIncome(),
                amount: $dto->getAmount()
            )
        );
    }

    /**
     * @throws Throwable
     */
    public function getBalance(int $userId): int {
        $wallet = $this->walletRepository->findByCondition(conditions: [[FieldEnum::userId->value, '=', $userId]]);
        throw_if(empty($wallet), new ModelNotFoundException(trans('exception.wallet.wallet_not_exists')));
        return $wallet->{FieldEnum::balance->value};
    }


    public function getUserWalletId(int $userId): int {
        return $this->walletRepository->findByCondition(
            conditions: [
                [
                    FieldEnum::userId->value,
                    '=',
                    $userId]
            ]
        )->offsetGet(FieldEnum::id->value);
    }

    /**
     * @param WalletDto $dto
     * @return Model|Transaction
     */
    public function createWallet(WalletDto $dto): Model|Wallet {
        return $this->walletRepository->firstOrCreate(
            [
                FieldEnum::userId->value => $dto->getUserId(),
            ],
            $dto->toArray());
    }

    public function create(WalletDto $dto): Model|Wallet {
        return $this->walletRepository->create($dto->toArray());
    }

    private function makeTransaction(TransactionDto $dto): Model|Wallet {
        return $this->repository->create($dto->toArray());
    }

    /**
     * @param int $walletId
     * @param string $fieldNane
     * @param int $amount
     * @return bool
     */
    public function updateBalance(int $walletId, string $fieldNane, int $amount): bool {
        $wallet = $this->walletRepository->findById($walletId);
        return $wallet->update([$fieldNane => $amount]);
    }

    public function findWallet(int $walletId): Model|Wallet {
        return $this->walletRepository->findById($walletId);
    }

}
