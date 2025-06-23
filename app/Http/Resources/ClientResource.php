<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'tax_id' => $this->tax_id,
            'foreign_tax_id' => $this->foreign_tax_id,
            'email' => $this->email,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
            'province' => $this->province,
            'phone_1' => $this->phone_1,
            'phone_2' => $this->phone_2,
            'accounting_code' => $this->accounting_code,
            'billing_by_ref' => $this->billing_by_ref,
            'country' => new CountryResource($this->whenLoaded('country')),
            'payment_term' => new PaymentTermResource($this->whenLoaded('paymentTerm')),
            'client_group' => new ClientGroupResource($this->whenLoaded('clientGroup')),
            'sales_rep' => new SalesRepResource($this->whenLoaded('salesRep')),
        ];
    }
}
