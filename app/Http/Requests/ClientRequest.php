<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class ClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function baseRules(): array
    {
        return [
            'description' => 'nullable|string',
            'tax_id' => 'nullable|string|max:50',
            'foreign_tax_id' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'postal_code' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'phone_1' => 'nullable|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'accounting_code' => 'nullable|string|max:50',
            'billing_by_ref' => 'nullable|string|max:50',
            'country_id' => 'required|exists:countries,id',
            'payment_term_id' => 'required|exists:payment_terms,id',
            'client_group_id' => 'required|exists:client_groups,id',
            'sales_rep_id' => 'required|exists:sales_reps,id',
        ];
    }
}