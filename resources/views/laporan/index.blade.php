@extends('layouts.master')


@section('top')
<style>
    .select2-container--default.select2-container--disabled .select2-selection--single {
      cursor: not-allowed
    }
  </style>
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css ')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}} ">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}} ">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.0/css/dataTables.dateTime.min.css">

  {{-- SweetAlert2 --}}
  <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
  <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" />

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css')}} ">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <!-- Log on to codeastro.com for more projects! -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header">
            <h3 class="box-title">Data Laporan</h3>
        </div>

        <div class="box-header">
            <form method="get" action="{{ route('laporans.search') }}" data-toggle="validator" autocomplete="off">
                {{ csrf_field() }} {{ method_field('GET') }}
            <div class="row">
                <div class="col-md-5">
                 <div class="input-group input-daterange">
                      <input data-date-format='yyyy-mm-dd' type="text"  class="form-control" id="from_date" name="from_date" placeholder="Dari tanggal" required>
                      <div class="input-group-addon">TO</div>
                      <input data-date-format='yyyy-mm-dd' type="text"  class="form-control" id="to_date" name="to_date" placeholder="Sampai tanggal" required>
                 </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                    <a href="/laporans" class="btn btn-warning"><i class="fa fa-refresh"></i> Refresh</a>
                </div>
               </div>
            </form>
        </div>

        <div class="box-header">
            <a href="/exportLaporanPdf?from_date={{request()->get('from_date')}}&to_date={{request()->get('to_date')}}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export PDF</a>
            <a href="/exportLaporanExcel?from_date={{request()->get('from_date')}}&to_date={{request()->get('to_date')}}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
            <table id="products-out-table" cellspacing="0" width="100%" class="table table-bordered table-hover table-striped display dataTable responsive">
                <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Produk</th>
                    <th>Ukuran</th>
                    <th>Warna</th>
                    <th>Reseller</th>
                    <th>Qty</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($data as $datas)
                        <tr>
                            <td>{{ $datas->kode_barang }}</td>
                            <td>{{ $datas->nama }}</td>
                            <td>{{ $datas->ukuran }}</td>
                            <td>{{ $datas->warna }}</td>
                            <td>{{ $datas->reseller }}</td>
                            <td>{{ $datas->qty }}</td>
                            <td>{{ $datas->tanggal}}</td>
                            <td>@currency($datas->total_harga)</td>
                        </tr>   
                    @endforeach
                        
                        <tr>
                            <th colspan="7">Total</th>
                            <th>@currency($sumprice)</th>
                        </tr>
                </tbody>
            </table>
    
        </div>
        <!-- /.box-body -->
    </div>
@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    <!-- Log on to codeastro.com for more projects! -->
    <!-- InputMask -->
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.js"></script>

    <script>
        $(function () {

            //Date picker
            $('#from_date').datepicker({
                autoclose: true,
                // dateFormat: 'yyyy-mm-dd'
            })
            $('#to_date').datepicker({
                autoclose: true,
                // dateFormat: 'yyyy-mm-dd'
            })

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })
        })
    </script>

@endsection
