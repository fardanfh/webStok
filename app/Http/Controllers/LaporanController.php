<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Exports\ExportLaporan;
use App\Product;
use App\Product_Keluar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LaporanController extends Controller
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
        $data = DB::table('laporan')->orderBy('tanggal', 'desc')->get();
        $sumprice = DB::table('laporan')->orderBy('tanggal', 'desc')->sum('total_harga');
        return view('laporan.index', compact('data', 'sumprice'));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }



    public function apiLaporan()
    {
        $product = Product_Keluar::all();

        return Datatables::of($product)
            ->addColumn('kode_barang', function ($product) {
                return $product->product->kode_barang;
            })
            ->addColumn('products_name', function ($product) {
                return $product->product->nama;
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
            ->rawColumns(['products_name', 'gambar', 'customer_name', 'action'])->make(true);
    }

    function search(Request $request)
    {

        if ($request->from_date != '' && $request->to_date != '') {
            $data = DB::table('laporan')
                ->whereBetween('tanggal', array($request->from_date, $request->to_date))
                ->get();
            $sumprice = DB::table('laporan')
                ->whereBetween('tanggal', array($request->from_date, $request->to_date))
                ->sum('total_harga');
        } else {
            $data = DB::table('laporan')->orderBy('tanggal', 'desc')->get();
        }



        return view('laporan.index', compact('data', 'sumprice',));
    }

    public function exportLaporanPdf(Request $request)
    {

        $data = DB::table('laporan')
            ->whereBetween('tanggal', array($request->from_date, $request->to_date))
            ->get();
        $sumprice = DB::table('laporan')
            ->whereBetween('tanggal', array($request->from_date, $request->to_date))
            ->sum('total_harga');

        $from = $request->from_date;
        $to = $request->to_date;

        $pdf = PDF::loadView('laporan.laporanPdf', compact('data', 'sumprice', 'from', 'to'));
        return $pdf->download($request->from_date . ' - ' . $request->to_date . '_Laporan.pdf');
    }

    public function exportLaporanExcel()
    {

        return (new ExportLaporan)->download('laporan.xlsx');
    }

    public function ExportExcel($customer_data, $from, $to, $total)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($customer_data);
            $sheet = $spreadSheet->getActiveSheet();
            $row = $sheet->getHighestRow() + 2;
            $rows = $sheet->getHighestRow() + 1;
            $sheet->insertNewRowBefore($row);
            $sheet->setCellValue('A' . $row, 'Laporan Tanggal : ' . $from . '  Sampai  ' . $to);
            $sheet->insertNewRowBefore($rows);
            $sheet->setCellValue('A' . $row, 'Total Harga     : ' . $total);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="LaporanData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    function exportDataExcel(Request $request)
    {
        $data = DB::table('laporan')
            ->whereBetween('tanggal', array($request->from_date, $request->to_date))
            ->get();
        $sumprice = DB::table('laporan')
            ->whereBetween('tanggal', array($request->from_date, $request->to_date))
            ->sum('total_harga');

        $data_array[] = array("KodeBarang", "Nama", "Reseller", "Qty", "Tanggal", "TotalHarga");
        foreach ($data as $data_item) {
            $data_array[] = array(
                'KodeBarang' => $data_item->kode_barang,
                'Nama' => $data_item->nama,
                'Reseller' => $data_item->reseller,
                'Qty' => $data_item->qty,
                'Tanggal' => $data_item->tanggal,
                'TotalHarga' => $data_item->total_harga,
            );
        }

        $this->ExportExcel($data_array, $request->from_date,  $request->to_date, $sumprice);
    }
}
