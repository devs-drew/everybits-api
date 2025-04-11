<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWalletRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'type' => ['sometimes', 'string', 'max:255', Rule::in(config('variables.wallet_types'))],
            'balance' => ['sometimes', 'numeric', 'min:0'],
            'credit_limit' => ['sometimes', 'numeric', 'min:0'],
            'include_in_total' => ['sometimes', 'boolean']
        ];
    }
}
