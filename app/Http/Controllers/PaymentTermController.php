<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentTermResource;
use App\Models\PaymentTerm;
use Illuminate\Http\Request;

class PaymentTermController extends Controller
{
    public function index()
    {
        return PaymentTermResource::collection(PaymentTerm::all())->resolve();
    }
}
