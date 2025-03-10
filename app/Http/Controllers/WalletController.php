<?php

namespace App\Http\Controllers;

use App\Contracts\Mediator\DtoMediatorContract;
use App\Contracts\Services\WalletServiceContract;
use App\Enum\DocumentType;
use App\Enum\FieldEnum;
use App\Exceptions\WalletAlreadyExistsException;
use App\Http\Requests\ChargeRequest;
use App\Http\Resources\ChargeResource;
use App\Http\Resources\WalletResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Throwable;

class WalletController extends Controller {

    /**
     * @param WalletServiceContract $service
     * @param DtoMediatorContract $dtoMediator
     */
    public function __construct(
        protected WalletServiceContract $service,
        protected DtoMediatorContract $dtoMediator,
    ) {
    }

    public function deposit(ChargeRequest $request): ChargeResource {
        $user = auth()->user();
        /* @var User $user */
        $walletId = $user->wallet()->first()->{FieldEnum::id->value};

        $response = $this->service->change(
            $this->dtoMediator->convertDataToWalletTransactionDto(
                userId: $user->{FieldEnum::id->value},
                type: DocumentType::WALLET,
                amount: $request->input(FieldEnum::amount->name),
                isIncome: true,
            )
        );
        return ChargeResource::make($response)->additional($this->getBalance($walletId));
    }

    /**
     * @throws Throwable
     */
    public function withdraw(ChargeRequest $request): ChargeResource {
        $user = auth()->user();
        /* @var User $user */
        $wallet = $user->wallet()->first();

        $response = $this->service->change(
            $this->dtoMediator->convertDataToWalletTransactionDto(
                userId: $user->{FieldEnum::id->value},
                type: DocumentType::WALLET,
                amount: $request->input(FieldEnum::amount->name),
                isIncome: false,
            )
        );
        return ChargeResource::make($response)->additional($this->getBalance($wallet->{FieldEnum::id->value}));
    }

    public function balance($walletId): JsonResponse {
        return response()->json($this->getBalance($walletId));
    }

    private function getBalance($walletId): array {
        $balance = $this->service->getBalance($walletId);
        return [
            FieldEnum::balance->value => $balance
        ];
    }

    /**
     * @throws Throwable
     */
    public function create(): WalletResource {
        $user = auth()->user();
        /* @var User $user */
        $wallet = $user->wallet()->first();
        throw_if(!empty($wallet), WalletAlreadyExistsException::class);
        $response = $this->service->create(
            $this->dtoMediator->convertDataToWalletDto(
                userId: $user->{FieldEnum::id->value}
            )
        );
        return WalletResource::make($response);
    }
}
