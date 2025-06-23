<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'tax_id',
        'foreign_tax_id',
        'email',
        'address',
        'postal_code',
        'city',
        'province',
        'phone_1',
        'phone_2',
        'accounting_code',
        'billing_by_ref',
        'country_id',
        'payment_term_id',
        'client_group_id',
        'sales_rep_id'
    ];

    protected $casts = [
        'country_id' => 'integer',
        'payment_term_id' => 'integer',
        'client_group_id' => 'integer',
        'sales_rep_id' => 'integer'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function paymentTerm()
    {
        return $this->belongsTo(PaymentTerm::class);
    }

    public function clientGroup()
    {
        return $this->belongsTo(ClientGroup::class);
    }

    public function salesRep()
    {
        return $this->belongsTo(SalesRep::class);
    }
}
