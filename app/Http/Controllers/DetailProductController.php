<?php

namespace App\Http\Controllers;

use App\DetailProduct;
use App\Product;
use App\Product_Keluar;
use App\Product_Masuk;
use App\Supplier;
use App\Ukuran;
use App\Warna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use UxWeb\SweetAlert\SweetAlert;

class DetailProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }

    public function index($id)
    {
        $products = Product::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');

        $details = DB::table('detail_produk')
            ->where('product_id', $id)
            ->get();

        $detail = DB::table('detail_products')
            ->where('product_id', $id)
            ->get();

        $produk = DB::table('products')
            ->where('id', $id)
            ->first();

        $ukuran = Ukuran::all();
        $warna = Warna::all();
        $data = Product::all();
        return view('detail.index', compact('product', 'ukuran', 'warna', 'data', 'details', 'produk', 'detail'));
    }

    public function detail($id)
    {
        $products = Product::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');

        $produk = DB::table('products')
            ->where('id', $id)
            ->first();

        $details = DB::table('detail_produk')
            ->where('product_id', $id)
            ->get();

        $detailz = DB::table('detail_produk')
            ->where('product_id', $id)
            ->pluck('gambar');



        $detail = DB::table('detail_products')
            ->where('product_id', $id)
            ->get();

        $ukuran = Ukuran::all();
        $warna = Warna::all();
        $data = Product::all();
        return view('detail.index', compact('products', 'ukuran', 'warna', 'data', 'details', 'produk', 'detail'));
    }

    public function show($id)
    {
        //
    }

    public function create()
    {
        $products = Product::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');

        $ukuran = Ukuran::all();
        $warna = Warna::all();
        $data = Product::all();
        return view('detail.forms', compact('products', 'ukuran', 'warna', 'data'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'product_id'      => 'required',
            'warna_id'    => 'required',
            'ukuran_id'     => 'required',
            'stok'   => 'required',
            'gambar' => 'required'
        ]);


        $details = DetailProduct::where([
            'product_id' => $request->product_id,
            'warna_id' => $request->warna_id,
            'ukuran_id' => $request->ukuran_id,
        ])->count();

        if ($details == 0) {
            $input = $request->all();
            $images = array();
            if ($files = $request->file('gambar')) {
                foreach ($files as $file) {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('/upload/products/'), $name);
                    $images[] = $name;
                }
            }
            DetailProduct::create([
                'product_id' => $request->product_id,
                'warna_id' => $request->warna_id,
                'ukuran_id' => $request->ukuran_id,
                'stok' => $request->stok,
                'gambar' => implode(",", $images),
            ]);
            //DetailProduct::create($request->all());
        } else {
            SweetAlert::error('Error', 'Data Sudah Ada');
        }

        return redirect('detail/' . $request->product_id);
    }

    function detailproduk($id)
    {
        $details = DB::table('detail_produk')
            ->where('detail_id', $id)
            ->get();
        return view('detail.detailproduk', compact('details'));
    }
}
