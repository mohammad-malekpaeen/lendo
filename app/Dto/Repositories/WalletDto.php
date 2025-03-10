<?php

namespace App\Dto\Repositories;

use App\Dto\BaseDto;
use App\Enum\FieldEnum;

class WalletDto extends BaseDto {

    /**
     * @param int $userId
     * @param int $balance
     */
    public function __construct(
        protected int $userId,
        protected int $balance = 0,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array {
        return [
            FieldEnum::userId->value  => $this->getUserId(),
            FieldEnum::balance->value => $this->getBalance(),
        ];
    }

    /**
     * @return int
     */
    public function getUserId(): int {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getBalance(): int {
        return $this->balance;
    }

}
