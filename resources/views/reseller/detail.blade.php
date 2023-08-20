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
            <h3 class="box-title">Detail Produk</h3><br><br>
        </div>

        <div class="box-body">
            <table id="products-table" cellspacing="0" width="100%" class="table table-bordered table-hover table-striped display dataTable responsive">
                <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Produk</th>
                    <th>Gambar</th>
                    <th>Ukuran</th>
                    <th>Warna</th>
                    <th>Stok</th>
                    <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($details as $p)
                        <tr>
                            <td>{{ $p->kode_barang }}</td>
                            <td>{{ $p->nama }}</td>
                            <td style="width: 200px"><img src="{{ $p->image }}" alt="" style="display:block;" width="100%" height="100%"></td>
                            <td>{{ $p->ukuran }}</td>
                            <td>{{ $p->warna }}</td>
                            <td>{{ $p->stok }}</td>
                            <td><a href="/reseller/product/detail/produk/{{$p->detail_id}}" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-info-sign"></i> Detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@endsection

@section('bot')

    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.js"></script>

    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    <script type="text/javascript">
        $('#products-table').DataTable({
                responsive: true,
                processing: true,
            }); 

        function formatRupiah(angka, prefix){
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
