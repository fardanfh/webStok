@extends('layouts.master')


@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.css">
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header">
            <h3 class="box-title">Data Harga Produk</h3>
        </div>


        <!-- /.box-header -->
        <div class="box-body">
            <table id="products-table" cellspacing="0" width="100%" class="table table-bordered table-hover table-striped display dataTable responsive">
                <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Produk</th>
                    <th>Harga Asli</th>
                    <th>Harga Jual</th>
                    <th>Selisih</th>
                </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    @include('products.form')

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.js"></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    {{--<script>--}}
    {{--$(function () {--}}
    {{--$('#items-table').DataTable()--}}
    {{--$('#example2').DataTable({--}}
    {{--'paging'      : true,--}}
    {{--'lengthChange': false,--}}
    {{--'searching'   : false,--}}
    {{--'ordering'    : true,--}}
    {{--'info'        : true,--}}
    {{--'autoWidth'   : false--}}
    {{--})--}}
    {{--})--}}
    {{--</script>--}}

    <script type="text/javascript">

        var table = $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('api.products') }}",
            columns: [
                {data: 'kode_barang', name: 'kode_barang'},
                {data: 'nama', name: 'nama'},
                {data: 'harga', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ),name: 'harga'},
                {data: 'harga_jual', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ), name: 'harga_jual'},
                {data: 'selisih', render: $.fn.dataTable.render.number( '.', ',', 0, 'Rp ' ),name: 'selisih'},
            ]
        });

        

        function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

        
    </script>

@endsection
