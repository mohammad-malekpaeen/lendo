<?php

namespace App\Models;

use App\Enum\DocumentType;
use App\Enum\FieldEnum;
use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy([TransactionObserver::class])]
class Transaction extends Model {

    /**
     * @var array
     */
    protected $fillable = [
        FieldEnum::walletId->value,
        FieldEnum::type->value,
        FieldEnum::isIncome->value,
        FieldEnum::amount->value,
    ];

    /**
     * @var class-string[]
     */
    protected $casts = [
        FieldEnum::type->value => DocumentType::class,
    ];

    /**
     * @return BelongsTo
     */
    public function wallet(): BelongsTo {
        return $this->belongsTo(Wallet::class, FieldEnum::walletId->value);
    }

}
