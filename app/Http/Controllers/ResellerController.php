<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ResellerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:reseller');
    }
    public function index()
    {
        //dd(auth('reseller')->user()->email);
        $data = DB::table('product_keluar')->where('customer_id', auth('reseller')->user()->id)->orderBy('id', 'desc')->get();

        return view('reseller.index', compact('data'));
    }
}
