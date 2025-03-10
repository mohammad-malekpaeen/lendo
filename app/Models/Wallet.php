<?php

namespace App\Models;

use App\Enum\FieldEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model {

	use SoftDeletes;

	/**
	 * @var array
	 */
	protected $fillable = [
		FieldEnum::userId->value,
		FieldEnum::balance->value,
	];

	/**
	 * @return HasMany
	 */
	public function transactions(): HasMany {
		return $this->hasMany(Transaction::class, FieldEnum::walletId->value);
	}

	public function user(): HasOne{
		return $this->hasOne(User::class, FieldEnum::id->value, FieldEnum::userId->value);
	}

}
