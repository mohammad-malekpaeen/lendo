<?php

namespace App\Listeners;

use App\Enum\FieldEnum;
use App\Events\TransactionCreated;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Services\WalletService;
use Illuminate\Database\Eloquent\Model;

class CreateTransaction {

    private Transaction $transaction;

    public function __construct(
        protected WalletService $walletService,
    ) {
    }

    public function handle(TransactionCreated $event): void {
        $this->transaction = $event->transaction;
        $this->updateBalance();
    }

    private function getWalletId(): int {
        return $this->transaction->{FieldEnum::walletId->value};
    }

    private function getWalletDocumentType(): int {
        return $this->transaction->{FieldEnum::type->value}->value;
    }

    private function getWallet(): Model|Wallet {
        return $this->walletService->findWallet($this->getWalletId());
    }

    private function updateBalance(): void {
        $isIncome = $this->transaction->{FieldEnum::isIncome->value};
        $balance = data_get($this->getWallet(), FieldEnum::balance->value);
        $amount = $this->transaction->{FieldEnum::amount->value};

        $amount = $isIncome ? ($balance + $amount) : ($balance - $amount);
        $this->walletService->updateBalance($this->getWalletId(), FieldEnum::balance->value, $amount);
    }
}
