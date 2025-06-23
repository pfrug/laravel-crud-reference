<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTerm extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentTermFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
