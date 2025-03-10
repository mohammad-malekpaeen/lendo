<?php

namespace App\Rules;

use App\Exceptions\MaxAmountChargeWalletException;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Throwable;

readonly class MaxChargeableAmountRule implements ValidationRule {
    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     * @throws Throwable
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $inRangeCondition = $value >= 100000000000000;
        throw_if($inRangeCondition, MaxAmountChargeWalletException::class);
    }

}
