<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WriterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        if($this->method() == "PATCH")
        {
            return [
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'portrait' => 'nullable|image|max:2048',
            ];
        }
        return [
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'portrait' => 'nullable|image|max:2048',
        ];
    }
}
