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
        $detail = DetailProduct::all();
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
            'product_id'     => 'required',
            'supplier_id'    => 'required',
            'qty'            => 'required',
            'tanggal'        => 'required'
        ]);

        // $detail = new DetailProduct;
        // $detail->product_id = $request->id;
        // $detail->ukuran_id = $request->ukuran_id;
        // $detail->warna_id = $request->warna_id;
        // $detail->stok = $request->qty;
        // $detail->save();
        //DetailProduct::create($request->all());

        Product_Masuk::create($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->qty += $request->qty;
        $product->save();

        //$detail = $produk_masuk->detail()->create($request->all());

        // //$detail = DetailProduct::where('product_id', $request->product_id)->first();


        // $ukuran = Ukuran::findOrFail($request->ukuran_id);
        // $warna = Warna::findOrFail($request->warna_id);

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
            'product_id'     => 'required',
            'supplier_id'    => 'required',
            'qty'            => 'required',
            'tanggal'        => 'required'
        ]);

        $product_masuk = Product_Masuk::findOrFail($id);
        $product_masuk->update($request->all());

        $product = Product::findOrFail($request->product_id);
        $product->qty += $request->qty;
        $product->update();

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
            ->addColumn('products_name', function ($product) {
                return $product->product->nama;
            })
            ->addColumn('supplier_name', function ($product) {
                return $product->supplier->nama;
            })
            ->addColumn('action', function ($product) {
                return '<a onclick="editForm(' . $product->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData(' . $product->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ';
            })
            ->rawColumns(['products_name', 'supplier_name', 'action'])->make(true);
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
