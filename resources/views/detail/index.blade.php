@extends('layouts.master')

@section('top')
    <!-- DataTables -->
    
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.css">
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header">
            <h3 class="box-title">Data Produk</h3>

            <a onclick="addForm()" class="btn btn-danger pull-right btn-lg" ><i class="fa fa-pencil"></i> &nbsp;TAMBAH KET. WARNA & UKURAN</a>
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
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($details as $p)
                        <tr>
                            <td>{{ $p->kode_barang }}</td>
                            <td>{{ $p->nama }}</td>
                            <td style="width: 150px; height: 160px"><img onclick="showImage()" src="{{ $p->image }}" alt="" style="display:block;" width="100%" height="100%"></td>
                           
                            <td>{{ $p->ukuran }}</td>
                            <td>{{ $p->warna }}</td>
                            <td>{{ $p->stok }}</td>
                            <td>
                                <a href="/detailproduk/{{$p->detail_id}}" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-info-sign"></i> Detail</a>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    @include('detail.form')


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

    <script type="text/javascript">

        $('#products-table').DataTable({
            responsive: true,
            processing: true,
        }); 

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah Ukuran & Warna');
        }

        function showImage(){
            $('#modal-image').modal('show');
            $('.modal-title').text('Gambar');
        }

        $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    var url = "{{ url('details') }}";

                    $.ajax({
                        url : '/detailStore',
                        type : "POST",
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });
    </script>

@endsection
