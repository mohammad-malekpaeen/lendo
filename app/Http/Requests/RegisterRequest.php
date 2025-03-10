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
class RegisterRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array {
        return [
            FieldEnum::name->name => 'required|string|max:255',
            FieldEnum::email->name => 'required|string|email|max:255|unique:users',
            FieldEnum::password->name =>  'required|string|min:8'
        ];
    }

}
