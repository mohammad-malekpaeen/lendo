<?php

namespace App\Http\Resources;

use App\Enum\FieldEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            FieldEnum::walletId->name      => $this->{FieldEnum::id->value},
            FieldEnum::balance->name => $this->{FieldEnum::balance->value},
            FieldEnum::createdAt->name => $this->{FieldEnum::createdAt->value}->toIso8601String(),
        ];
    }
}
