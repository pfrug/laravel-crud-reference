<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalesRepResource;
use App\Models\SalesRep;
use Illuminate\Http\Request;

class SalesRepController extends Controller
{
    public function index()
    {
        return SalesRepResource::collection(SalesRep::all());
    }
}
