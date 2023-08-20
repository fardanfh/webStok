<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\DetailProduct;
use App\Exports\ExportProdukKeluar;
use App\Product;
use App\Product_Keluar;
use App\Ukuran;
use App\Warna;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use PDF;

class ProductKeluarController extends Controller
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

        $data = Product::all();

        $gambars = Product::orderBy('nama', 'ASC')
            ->get()
            ->pluck('image', 'id');

        $customers = Customer::orderBy('nama', 'ASC')
            ->get()
            ->pluck('nama', 'id');
        $ukuran = Ukuran::all();
        $warna = Warna::all();
        $invoice_data = Product_Keluar::all();
        $detail = DetailProduct::orderBy('product_id')->get();

        return view('product_keluar.index', compact('products', 'customers', 'data', 'invoice_data', 'detail', 'ukuran', 'warna'));
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
            'customer_id'    => 'required',
            'qty'            => 'required',
            'tanggal'           => 'required'
        ]);

        $detail = DetailProduct::findOrFail($request->detail_id);
        $pm = new Product_Keluar();

        $pm->product_id = $detail->product_id;
        $pm->detail_id  = $request->detail_id;
        $pm->customer_id  = $request->customer_id;
        $pm->qty = $request->qty;
        $pm->tanggal = $request->tanggal;

        $pm->save();

        $detail->stok -= $request->qty;
        $detail->save();

        // Product_Keluar::create($request->all());

        // $product = Product::findOrFail($request->product_id);
        // $product->qty -= $request->qty;
        // $product->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Products Out Created'
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
        $product_keluar = Product_Keluar::find($id);
        return $product_keluar;
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
            'customer_id'    => 'required',
            'qty'            => 'required',
            'tanggal'           => 'required'
        ]);

        $detail = DetailProduct::findOrFail($request->detail_id);
        $pm = Product_Keluar::findOrFail($id);

        $pm->update($request->all());

        $detail->stok += $request->qty;
        $detail->update();

        return response()->json([
            'success'    => true,
            'message'    => 'Product Out Updated'
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
        Product_Keluar::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Products Delete Deleted'
        ]);
    }



    public function apiProductsOut()
    {
        $product = Product_Keluar::all();


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
            ->addColumn('customer_name', function ($product) {
                return $product->customer->nama;
            })
            ->addColumn('total_harga', function ($product) {
                $totalHarga = $product->product->harga * $product->qty;
                return $totalHarga;
            })
            ->addColumn('gambar', function ($product) {
                if ($product->product->image == NULL) {
                    return 'No Image';
                }
                return '<img style="display:block;" width="100%" height="100%"  src="' . url($product->product->image) . '" alt="">';
            })
            ->addColumn('action', function ($product) {
                return '<a onclick="editForm(' . $product->id . ')" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData(' . $product->id . ')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['products_name', 'ukuran', 'warna', 'gambar', 'customer_name', 'action'])->make(true);
    }

    public function exportProductKeluarAll()
    {
        $product_keluar = Product_Keluar::all();
        $pdf = PDF::loadView('product_keluar.productKeluarAllPDF', compact('product_keluar'));
        return $pdf->download('product_out.pdf');
    }

    public function exportProductKeluar($id)
    {
        $product_keluar = Product_Keluar::findOrFail($id);
        $pdf = PDF::loadView('product_keluar.productKeluarPDF', compact('product_keluar'));
        return $pdf->download($product_keluar->id . '_product_out.pdf');
    }

    public function exportExcel()
    {
        return (new ExportProdukKeluar)->download('product_keluar.xlsx');
    }
}
