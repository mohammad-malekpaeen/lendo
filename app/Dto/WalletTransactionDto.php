<?php

namespace App\Dto;

use App\Enum\DocumentType;
use App\Enum\FieldEnum;

class WalletTransactionDto extends BaseDto {

    /**
     * @param int $userId
     * @param DocumentType|null $type
     * @param int $amount
     * @param bool $isIncome
     */
	public function __construct(
		protected int $userId,
		protected ?DocumentType $type = null,
		protected int $amount = 0,
		protected bool $isIncome = false,
	) {}


	public function toArray(): array {
		return [
			FieldEnum::userId->value => $this->getUserId(),
			FieldEnum::type->value   => $this->getType(),
			FieldEnum::amount->value => $this->getAmount(),
			FieldEnum::isIncome->value => $this->getAmount(),
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
	public function getUserId(): int {
		return $this->userId;
	}


    public function isIncome(): bool {
        return $this->isIncome;
    }

}
