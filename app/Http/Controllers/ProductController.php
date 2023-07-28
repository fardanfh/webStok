<?php

namespace App\Http\Controllers;

use App\Category;
use App\DetailProduct;
use App\Product;
use App\Ukuran;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
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
        $producs = Product::all();
        $category = Category::orderBy('name', 'ASC')
            ->get()
            ->pluck('name', 'id');
        $detail = DetailProduct::all();

        return view('products.index', compact('category', 'producs', 'detail'));
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
        $category = Category::orderBy('name', 'ASC')
            ->get()
            ->pluck('name', 'id');

        $this->validate($request, [
            'kode_barang'   => 'required',
            'nama'          => 'required|string',
            'harga'         => 'required',
            'harga_jual'    => 'required',
            'qty'           => 'required',
            'image'         => 'required',
            'category_id'   => 'required',
        ]);

        $input = $request->all();
        $input['image'] = null;

        if ($request->hasFile('image')) {
            $input['image'] = '/upload/products/' . str_slug($input['nama'], '-') . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        $product = Product::create($input);
        // $detail = new DetailProduct;
        // $detail->product_id = $product->id;
        // $detail->ukuran_id = $request->ukuran_id;
        // $detail->warna_id = $request->warna_id;
        // $detail->stok = $request->qty;
        // $detail->save();

        return response()->json([
            'success' => true,
            'message' => 'Products Created'
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
        $category = Category::orderBy('name', 'ASC')
            ->get()
            ->pluck('name', 'id');
        $product = Product::find($id);
        return $product;
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
        $category = Category::orderBy('name', 'ASC')
            ->get()
            ->pluck('name', 'id');

        $this->validate($request, [
            'kode_barang'   => 'required',
            'nama'          => 'required|string',
            'harga'         => 'required',
            'harga_jual'    => 'required',
            'qty'           => 'required',
            //            'image'         => 'required',
            'category_id'   => 'required',
        ]);

        $input = $request->all();
        $produk = Product::findOrFail($id);

        $input['image'] = $produk->image;

        if ($request->hasFile('image')) {
            if (!$produk->image == NULL) {
                unlink(public_path($produk->image));
            }
            $input['image'] = '/upload/products/' . str_slug($input['nama'], '-') . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload/products/'), $input['image']);
        }

        $produk->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Products Update'
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
        $product = Product::findOrFail($id);

        if (!$product->image == NULL) {
            unlink(public_path($product->image));
        }

        Product::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Products Deleted'
        ]);
    }

    public function apiProducts()
    {
        $product = Product::all();

        return Datatables::of($product)
            ->addColumn('category_name', function ($product) {
                return $product->category->name;
            })
            ->addColumn('selisih', function ($product) {
                $selisih = $product->harga_jual - $product->harga;
                return $selisih;
            })
            ->addColumn('total', function ($product) {
                $stok = DetailProduct::where('product_id', $product->id)->sum('stok');
                return $stok;
            })
            ->addColumn('show_photo', function ($product) {
                if ($product->image == NULL) {
                    return 'No Image';
                }
                return '<img class="rounded-square img-responsive"  src="' . url($product->image) . '" alt="">';
            })
            ->addColumn('action', function ($product) {
                return '<a onclick="editForm(' . $product->id . ')" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData(' . $product->id . ')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Delete</a>' .
                    ' <a href="/products/detail/' . $product->id . '" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-info-sign"></i> Detail</a>' .
                    ' <a href="#" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i> Ukuran</a>';
            })
            ->rawColumns(['category_name', 'show_photo', 'action', 'total'])->make(true);
    }

    function detail($id)
    {
        $producs = Product::all();
        $category = Category::orderBy('name', 'ASC')
            ->get()
            ->pluck('name', 'id');
        $detail = DetailProduct::where('product_id', $id);
        $details = DB::table('detail_produk')
            ->where('product_id', $id)
            ->get();

        return view('products.detail', compact('category', 'producs', 'details'));
    }
}
