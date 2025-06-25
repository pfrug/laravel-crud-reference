<?php

namespace App\Http\Requests;

use App\Helpers\Sanitizers;
use Illuminate\Foundation\Http\FormRequest;

abstract class ClientRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $sanitizedData = [];

        if ($this->has('tax_id')) {
            $sanitizedData['tax_id'] = Sanitizers::alphanumeric($this->input('tax_id'));
        }

        if ($this->has('foreign_tax_id')) {
            $sanitizedData['foreign_tax_id'] = Sanitizers::alphanumeric($this->input('foreign_tax_id'));
        }

        $this->merge($sanitizedData);
    }
}