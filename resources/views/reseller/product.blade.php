@extends('template.master')

@section('top')
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css ')}}">
  <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}} ">
  <link rel="stylesheet" href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css')}} ">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.css">

  <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
  <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" />

  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css')}} ">
  <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
<div class="box box-primary">

    <div class="box-header">
        <h3 class="box-title">Data Produk</h3>
    </div>

    <div class="box-body">
        <table id="products-table" cellspacing="0" width="100%" class="table table-bordered table-hover table-striped display dataTable responsive">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                    <tr>
                        <td>{{ $p->kode_barang }}</td>
                        <td style="width: 200px"><img src="{{ $p->image }}" alt="" style="display:block;" width="100%" height="100%"></td>
                        <td>{{ $p->nama }}</td>
                        <td>@currency($p->harga)</td>
                        <td>{{ $p->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('bot')

<script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

<script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

<script src="{{ asset('assets/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>

<script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>

<script src="{{ asset('assets/validator/validator.min.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.js"></script>

<script type="text/javascript">
    $('#products-table').DataTable({
        responsive: true,
        processing: true,
    }); 
</script>
@endsection
