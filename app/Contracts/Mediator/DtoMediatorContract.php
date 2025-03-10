<?php

namespace App\Contracts\Mediator;

use App\Dto\Repositories\UserDto;
use App\Dto\WalletTransactionDto;
use App\Enum\DocumentType;
use App\Dto\Repositories\WalletDto;

interface DtoMediatorContract {

    /**
     * @param int $userId
     * @param DocumentType|null $type
     * @param int $amount
     * @param bool $isIncome
     * @return WalletTransactionDto
     */
    public function convertDataToWalletTransactionDto(
        int $userId,
        ?DocumentType $type = null,
        int $amount = 0,
        bool $isIncome = false,
    ): WalletTransactionDto;

    /**
     * @param int $userId
     * @param int $balance
     * @return WalletDto
     */
    public function convertDataToWalletDto(
        int $userId,
        int $balance = 0,
    ): WalletDto;

    public function convertDataToUserDto(
        string $name,
        string $email,
        string $password,
    ): UserDto;


}
