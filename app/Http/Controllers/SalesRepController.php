<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalesRepResource;
use App\Models\SalesRep;

class SalesRepController extends Controller
{
    public function index()
    {
        return SalesRepResource::collection(SalesRep::all())->resolve();
    }
}
