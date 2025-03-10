<?php

namespace App\Http\Requests;

use App\Enum\FieldEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class LoginRequest extends FormRequest {

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
            FieldEnum::email->name => 'required|string|email|max:255|exists:users',
            FieldEnum::password->name =>  'required|string|min:8'
        ];
    }

}
