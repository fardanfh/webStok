<?php

namespace App\Http\Controllers;


use App\Customer;
use App\Exports\ExportCustomers;
use App\Exports\ExportLaporan;
use App\Imports\CustomersImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Excel;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class CustomerController extends Controller
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
        $customers = Customer::all();
        return view('customers.index');
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
            'nama'      => 'required',
            'alamat'    => 'required',
            'email'     => 'required|unique:customers',
            'telepon'   => 'required',
        ]);

        //Customer::create(Hash::make($request->password));
        $customer = Customer::create($request->all());
        $customer->password = Hash::make($request->get('password'));
        $customer->save();

        return response()->json([
            'success'    => true,
            'message'    => 'Customer Created'
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
        $customer = Customer::find($id);
        return $customer;
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
            'nama'      => 'required|string|min:2',
            'alamat'    => 'required|string|min:2',
            'email'     => 'required|string|email|max:255|unique:customers',
            'telepon'   => 'required|string|min:2',
        ]);

        $customer = Customer::findOrFail($id);

        $customer->update($request->all());

        return response()->json([
            'success'    => true,
            'message'    => 'Customer Updated'
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
        Customer::destroy($id);

        return response()->json([
            'success'    => true,
            'message'    => 'Customer Delete'
        ]);
    }

    public function apiCustomers()
    {
        $customer = Customer::all();

        return Datatables::of($customer)
            ->addColumn('action', function ($customer) {
                return '<a onclick="editForm(' . $customer->id . ')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData(' . $customer->id . ')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a> ' .
                    '<a href="/transaksiReseller/' . $customer->id . '" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-credit-card"></i> Transaksi</a> ';
            })
            ->rawColumns(['action'])->make(true);
    }

    public function ImportExcel(Request $request)
    {
        //Validasi
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);

        if ($request->hasFile('file')) {
            //UPLOAD FILE
            $file = $request->file('file'); //GET FILE
            Excel::import(new CustomersImport, $file); //IMPORT FILE
            return redirect()->back()->with(['success' => 'Upload file data customers !']);
        }

        return redirect()->back()->with(['error' => 'Please choose file before!']);
    }


    public function exportCustomersAll()
    {
        $customers = Customer::all();
        $pdf = PDF::loadView('customers.CustomersAllPDF', compact('customers'));
        return $pdf->download('customers.pdf');
    }

    public function exportExcel()
    {
        return (new ExportCustomers)->download('customers.xlsx');
    }

    function transaksi($id)
    {
        $data = DB::table('transaksireseller')
            ->where('customers_id', $id)
            ->get();

        $datas = DB::table('transaksireseller')
            ->where('customers_id', $id)
            ->first();

        $sumprice = DB::table('transaksireseller')
            ->where('customers_id', $id)
            ->sum('total_harga');
        return view('customers.transaksi', compact('data', 'sumprice', 'datas'));
    }

    function search($id, Request $request)
    {
        if ($request->from_date != '' && $request->to_date != '') {
            $data = DB::table('transaksireseller')
                ->where('customers_id', $id)
                ->whereBetween('tanggal', array($request->from_date, $request->to_date))
                ->get();
            $datas = DB::table('transaksireseller')
                ->where('customers_id', $id)
                ->first();
            $sumprice = DB::table('transaksireseller')
                ->where('customers_id', $id)
                ->whereBetween('tanggal', array($request->from_date, $request->to_date))
                ->sum('total_harga');
        } else {
            $data = DB::table('transaksireseller')->orderBy('tanggal', 'desc')->get();
        }

        return view('customers.transaksi', compact('data', 'sumprice', 'datas'));
    }

    public function exportTransaksiPdf($id, Request $request)
    {

        $data = DB::table('transaksireseller')
            ->where('customers_id', $id)
            ->whereBetween('tanggal', array($request->from_date, $request->to_date))
            ->get();
        $sumprice = DB::table('transaksireseller')
            ->where('customers_id', $id)
            ->whereBetween('tanggal', array($request->from_date, $request->to_date))
            ->sum('total_harga');

        $from = $request->from_date;
        $to = $request->to_date;

        $pdf = PDF::loadView('laporan.laporanPdf', compact('data', 'sumprice', 'from', 'to'));
        return $pdf->download($request->from_date . ' - ' . $request->to_date . '_Laporan.pdf');
    }

    public function ExportExcels($customer_data, $from, $to, $total)
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

    function exportDataExcel($id, Request $request)
    {
        $data = DB::table('transaksireseller')
            ->where('customers_id', $id)
            ->whereBetween('tanggal', array($request->from_date, $request->to_date))
            ->get();
        $sumprice = DB::table('transaksireseller')
            ->where('customers_id', $id)
            ->whereBetween('tanggal', array($request->from_date, $request->to_date))
            ->sum('total_harga');

        $data_array[] = array("KodeBarang", "Nama", "Ukuran", "Warna", "Reseller", "Qty", "Tanggal", "TotalHarga");
        foreach ($data as $data_item) {
            $data_array[] = array(
                'KodeBarang' => $data_item->kode_barang,
                'Nama' => $data_item->nama,
                'Ukuran' => $data_item->ukuran,
                'Warna' => $data_item->warna,
                'Reseller' => $data_item->reseller,
                'Qty' => $data_item->qty,
                'Tanggal' => $data_item->tanggal,
                'TotalHarga' => $data_item->total_harga,
            );
        }

        $this->ExportExcels($data_array, $request->from_date,  $request->to_date, $sumprice);
    }
}
