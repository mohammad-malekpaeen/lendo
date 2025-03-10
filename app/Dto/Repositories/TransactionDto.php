<?php

namespace App\Dto\Repositories;

use App\Dto\BaseDto;
use App\Enum\DocumentType;
use App\Enum\FieldEnum;

class TransactionDto extends BaseDto {

    /**
     * @param int $walletId
     * @param DocumentType $type
     * @param int $amount
     * @param bool $isIncome
     */
    public function __construct(
        protected int $walletId,
        protected DocumentType $type,
        protected bool $isIncome,
        protected int $amount = 0,
    ) {
    }

    public function isIncome(): bool {
        return $this->isIncome;
    }

    public function toArray(): array {
        return [
            FieldEnum::walletId->value => $this->getWalletId(),
            FieldEnum::type->value     => $this->getType(),
            FieldEnum::isIncome->value => $this->isIncome(),
            FieldEnum::amount->value   => $this->getAmount(),
        ];
    }

    public function getType(): ?DocumentType {
        return $this->type;
    }

    public function getAmount(): int {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getWalletId(): int {
        return $this->walletId;
    }

}
