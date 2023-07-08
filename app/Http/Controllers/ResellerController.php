<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResellerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:customers');
    }
    public function index()
    {
        return view('reseller.index');
    }
}
