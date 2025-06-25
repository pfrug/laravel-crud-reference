<?php

namespace App\Http\Requests;

use App\Rules\ValidSpanishNif;

class PatchClientRequest extends ClientRequest
{
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'tax_id' => ['sometimes', 'nullable', 'string', 'max:15', new ValidSpanishNif],
            'foreign_tax_id' => ['sometimes', 'nullable', 'string', 'max:15', new ValidSpanishNif],
            'email' => 'sometimes|required|email|max:255|unique:clients,email,' . $this->route('client')->id,
            'address' => 'sometimes|nullable|string',
            'postal_code' => 'sometimes|nullable|string|max:10',
            'city' => 'sometimes|nullable|string|max:255',
            'province' => 'sometimes|nullable|string|max:255',
            'phone_1' => 'sometimes|nullable|string|max:255',
            'phone_2' => 'sometimes|nullable|string|max:255',
            'accounting_code' => 'sometimes|nullable|string|max:10',
            'billing_by_ref' => 'sometimes|boolean',
            'country_id' => 'sometimes|exists:countries,id',
            'payment_term_id' => 'sometimes|exists:payment_terms,id',
            'client_group_id' => 'sometimes|exists:client_groups,id',
            'sales_rep_id' => 'sometimes|exists:sales_reps,id',
        ];
    }
}
