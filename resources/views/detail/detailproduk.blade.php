@extends('layouts.master')

@section('top')
    <!-- DataTables -->
    
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.css">
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">

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

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>


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

@endsection
