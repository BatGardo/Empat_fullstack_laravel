<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // access for all, need authorization logic
    }

    // Validation rule cor create product
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ];
    }

    // Failed validation -> storage->logs->laravel.log
    protected function failedValidation(Validator $validator): void
    {
        Log::warning('Product was not created due to validation failure', [
            'errors' => $validator->errors()->toArray(),
            'input' => $this->all(),
            'ip' => $this->ip(),
        ]);

        parent::failedValidation($validator);
    }
}
