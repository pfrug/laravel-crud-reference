<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientGroup extends Model
{
    /** @use HasFactory<\Database\Factories\ClientGroupFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
