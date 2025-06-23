<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends ClientRequest
{
    public function rules(): array
    {
        return array_merge([
            'name' => 'required|string|max:255',
        ], $this->baseRules());
    }
}