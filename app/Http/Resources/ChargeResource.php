<?php

namespace App\Http\Resources;

use App\Enum\FieldEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChargeResource extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            FieldEnum::transactionId->name => $this->{FieldEnum::id->value},
            FieldEnum::type->name          => $this->{FieldEnum::type->value}->name,
            FieldEnum::isIncome->name      => $this->{FieldEnum::isIncome->value},
            FieldEnum::amount->name        => $this->{FieldEnum::amount->value},
            FieldEnum::createdAt->name     => $this->{FieldEnum::createdAt->value}->toIso8601String(),
        ];
    }
}
