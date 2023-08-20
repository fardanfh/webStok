<?php

namespace App\Http\Controllers;

use App\Category;
use App\DetailProduct;
use App\Product;
use App\Product_Keluar;
use App\Ukuran;
use App\Warna;
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

    function product()
    {
        $products = Product::all();
        $details = DetailProduct::all();
        $stok = DetailProduct::where('product_id', '13')->sum('stok');
        return view('reseller.product', compact('products', 'details', 'stok'));
    }

    function transaksi()
    {
        $id_cus = auth('reseller')->user()->id;
        $transaksi = DB::table('transaksi_reseller')->where('customers_id', $id_cus)->orderBy('tanggal', 'desc')->get();

        return view('reseller.transaksi', compact('transaksi'));
    }

    function detail($id)
    {
        $producs = Product::all();
        $category = Category::orderBy('name', 'ASC')
            ->get()
            ->pluck('name', 'id');
        $detail = DetailProduct::where('product_id', $id)->first();

        $details = DB::table('detail_produk')
            ->where('product_id', $id)
            ->get();

        $products = Product::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');

        $ukuran = Ukuran::all();
        $warna = Warna::all();
        $data = Product::all();

        return view('reseller.detail', compact('category', 'producs', 'details', 'products', 'ukuran', 'warna', 'data', 'detail'));
    }

    function detailproduk($id)
    {
        $details = DB::table('detail_produk')
            ->where('detail_id', $id)
            ->get();
        return view('reseller.detailproduk', compact('details'));
    }
}
