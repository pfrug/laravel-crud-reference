<?php

namespace App\Http\Requests;

use App\Rules\ValidSpanishNif;

class UpdateClientRequest extends ClientRequest
{

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'tax_id' => ['nullable', 'string', 'max:15', new ValidSpanishNif],
            'foreign_tax_id' => ['nullable', 'string', 'max:15', new ValidSpanishNif],
            'email' => 'sometimes|required|email|max:255|unique:clients,email,' . $this->route('client')->id,
            'address' => 'nullable|string',
            'postal_code' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'phone_1' => 'nullable|string|max:255',
            'phone_2' => 'nullable|string|max:255',
            'accounting_code' => 'nullable|string|max:10',
            'billing_by_ref' => 'boolean',
            'country_id' => 'required|exists:countries,id',
            'payment_term_id' => 'required|exists:payment_terms,id',
            'client_group_id' => 'required|exists:client_groups,id',
            'sales_rep_id' => 'required|exists:sales_reps,id',
        ];
    }
}