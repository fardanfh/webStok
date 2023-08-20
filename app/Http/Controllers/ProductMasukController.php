<?php

namespace App\Http\Controllers;

use App\DetailProduct;
use App\Exports\ExportProdukMasuk;
use App\Product;
use App\Product_Masuk;
use App\Supplier;
use App\Ukuran;
use App\Warna;
use PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ProductMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');

        $suppliers = Supplier::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');

        $invoice_data = Product_Masuk::all();
        $ukuran = Ukuran::all();
        $warna = Warna::all();
        $data = Product::all();
        $detail = DetailProduct::orderBy('product_id')->get();
        return view('product_masuk.index', compact('products', 'suppliers', 'invoice_data', 'ukuran', 'warna', 'data', 'detail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'detail_id'     => 'required',
            'stok'            => 'required',
            'tanggal'        => 'required'
        ]);

        $detail = DetailProduct::findOrFail($request->detail_id);
        $pm = new Product_Masuk();

        $pm->product_id = $detail->product_id;
        $pm->detail_id  = $request->detail_id;
        $pm->stok = $request->stok;
        $pm->tanggal = $request->tanggal;

        $pm->save();

        $detail->stok += $request->stok;
        $detail->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Products In Created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = DetailProduct::find($id);
        $product_masuk = Product_Masuk::find($id);
        return $product_masuk;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'detail_id'     => 'required',
            'stok'            => 'required',
            'tanggal'        => 'required'
        ]);

        $detail = DetailProduct::findOrFail($request->detail_id);
        $pm = Product_Masuk::findOrFail($id);

        // $pm->product_id = $detail->product_id;
        // $pm->detail_id  = $request->detail_id;
        // $pm->stok = $request->stok;
        // $pm->tanggal = $request->tanggal;

        $pm->update($request->all());

        // $pm->update();

        $detail->stok += $request->stok;
        $detail->update();


        // $detail = new DetailProduct;

        // $product_masuk = Product_Masuk::findOrFail($id);


        // $detail->product_id = $request->product_id;
        // $detail->warna_id = $request->warna_id;
        // $detail->ukuran_id = $request->ukuran_id;
        // $detail->stok = $request->stok;
        // $detail->update();

        // $product = Product::findOrFail($request->product_id);
        // $product->qty += $request->qty;
        // $product->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Product In Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product_Masuk::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Products In Deleted'
        ]);
    }



    public function apiProductsIn()
    {
        $product = Product_Masuk::all();


        return Datatables::of($product)
            ->addColumn('kode_barang', function ($product) {
                return $product->product->kode_barang;
            })
            ->addColumn('products_name', function ($product) {
                return $product->product->nama;
            })
            ->addColumn('ukuran', function ($product) {
                return $product->detail->ukuran->ukuran;
            })
            ->addColumn('warna', function ($product) {
                return $product->detail->warna->warna;
            })
            ->addColumn('action', function ($product) {
                return '<a onclick="editForm(' . $product->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData(' . $product->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
            })
            ->rawColumns(['kode_barang', 'products_name', 'ukuran', 'warna', 'action'])->make(true);
    }

    public function exportProductMasukAll()
    {
        $product_masuk = Product_Masuk::all();
        $pdf = PDF::loadView('product_masuk.productMasukAllPDF', compact('product_masuk'));
        return $pdf->download('product_enter.pdf');
    }

    public function exportProductMasuk($id)
    {
        $product_masuk = Product_Masuk::findOrFail($id);
        $pdf = PDF::loadView('product_masuk.productMasukPDF', compact('product_masuk'));
        return $pdf->download($product_masuk->id . '_product_enter.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProdukMasuk)->download('product_masuk.xlsx');
    }
}
