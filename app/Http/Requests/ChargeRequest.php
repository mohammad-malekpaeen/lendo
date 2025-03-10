<?php

namespace App\Http\Requests;

use App\Enum\FieldEnum;
use App\Exceptions\MinAmountChargeWalletException;
use App\Rules\MaxChargeableAmountRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Throwable;

/**
 *
 */
class ChargeRequest extends FormRequest {

    public function authorize(): bool {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array {
        return [
            FieldEnum::amount->name => ['min:1000', 'numeric', new MaxChargeableAmountRule()],
        ];
    }

    /**
     * @throws ValidationException
     * @throws MinAmountChargeWalletException|Throwable
     */
    protected function failedValidation(Validator $validator): void {
        $errors = $validator->errors();
        $rules = $validator->failed();
        throw_if(Arr::has($rules, 'amount.Min'), MinAmountChargeWalletException::class);

        parent::failedValidation($validator);
    }

}
