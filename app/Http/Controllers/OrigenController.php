<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Origen;

class OrigenController extends Controller
{
    //
    public function index()
    {
        return Origen::all();
    }
}
