<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandlePaymentWithCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'         => ['required', 'string', 'min:8'],
            'number'       => ['required', 'string', 'max:17'],
            'cep'          => ['required', 'string', 'min:9', 'max:9'],
            'expiry-month' => ['required', 'string'],
            'expiry-year'  => ['required', 'string'],
            'ccv'          => ['required', 'string', 'min:3', 'max:4'],
            'phone-number' => ['required', 'string'],
            'home-number'  => ['required', 'string'],
        ];
    }
}
