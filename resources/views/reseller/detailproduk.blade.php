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
        <h1 class="box-title">Detail Produk</h1>
    </div>

    @foreach ($details as $dt)
        <div class="box-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="main-image">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                  <div class="item active">
                                    <center>
                                        <img src="{{$dt->image}}" alt="" srcset="" class="rounded mx-auto d-block" style="width: 40%; height: 500px;">
                                    </center>
                                    
                                  </div>
                                    @foreach (explode(",",$dt->gambar) as $im)
                                    <div class="item">
                                        <center>
                                            <img src="/upload/products/{{ $im }}" alt="" class="rounded mx-auto d-block" style="width: 40%; height: 500px;">
                                        </center>
                                    </div>
                                    @endforeach
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                  <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                  <span class="fa fa-angle-right"></span>
                                </a>
                              </div>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <h1>{{$dt->nama}}</h1>
                        <b>Ukuran</b>
                        <p>{{$dt->ukuran}}</p>
                        <b>Warna</b>
                        <p>{{$dt->warna}}</p>
                        <b>Stok</b>
                        <p>{{$dt->stok}}</p>
                        <b>Deskripsi</b>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora, expedita debitis sapiente ab magni perferendis iusto. Quasi, esse saepe. Velit culpa quos voluptates aut quae explicabo non cumque quod voluptatem?</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
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
