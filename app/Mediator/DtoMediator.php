<?php

namespace App\Mediator;

use App\Contracts\Mediator\DtoMediatorContract;
use App\Dto\Repositories\UserDto;
use App\Dto\Repositories\WalletDto;
use App\Dto\WalletTransactionDto;
use App\Enum\DocumentType;

class DtoMediator implements DtoMediatorContract {

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
    ): WalletTransactionDto {
        return new WalletTransactionDto(
            userId: $userId,
            type: $type,
            amount: $amount,
            isIncome: $isIncome
        );
    }

    /**
     * @param int $userId
     * @param int $balance
     * @return WalletDto
     */
    public function convertDataToWalletDto(
        int $userId,
        int $balance = 0,
    ): WalletDto {
        return new WalletDto(
            userId: $userId,
            balance: $balance,
        );
    }

    public function convertDataToUserDto(
        string $name,
        string $email,
        string $password,
    ): UserDto {
        return new UserDto(
            name: $name,
            email: $email,
            password: $password,
        );
    }

}
