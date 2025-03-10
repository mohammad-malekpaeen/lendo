<?php

namespace App\Dto;

use App\Enum\FieldEnum;

class SummaryBalanceDto extends BaseDto {

    /**
     * @param int|null $balance
     */
    public function __construct(
        protected ?int $balance = 0,
    ) {
    }

    /**
     * @return array
     */
    public function toArray(): array {
        return [
            FieldEnum::balance->value => $this->getBalance(),
        ];
    }

    public function getBalance(): ?int {
        return $this->balance;
    }

}
