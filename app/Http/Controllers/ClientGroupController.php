<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientGroupResource;
use App\Models\ClientGroup;
use Illuminate\Http\Request;

class ClientGroupController extends Controller
{
    public function index()
    {
        return ClientGroupResource::collection(ClientGroup::all());
    }
}
