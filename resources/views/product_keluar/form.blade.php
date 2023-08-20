<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog"><!-- Log on to codeastro.com for more projects! -->
        <div class="modal-content">
            <form  id="form-item" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>


                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="product_id" name="product_id">


                    <div class="box-body">

                        <div class="form-group">
                            <label >Produk</label><br>
                            <select name="detail_id" id="detail_id" class="form-control select" style="width: 100%">
                                <option value="">- Pilih Produk -</option>
                                @foreach ($detail as $product)
                                    <option value="{{$product->id}}">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {{$product->product->kode_barang}}
                                                </div>
                                                <div class="col-md-6">
                                                    &nbsp;&nbsp;&nbsp;
                                                </div>
                                                <div class="col-md-6">
                                                    {{$product->product->nama}}
                                                </div>
                                                <div class="col-md-6">
                                                    &nbsp;&nbsp;&nbsp;
                                                </div>
                                                <div class="col-md-6">
                                                    <b style="font-weight: bold">{{$product->ukuran->ukuran}}</b> 
                                                </div>
                                                <div class="col-md-6">
                                                    &nbsp;&nbsp;&nbsp;
                                                </div>
                                                <div class="col-md-6">
                                                    {{$product->warna->warna}}
                                                </div>
                                            </div>
                                        </div>
                                    </option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Reseller</label><br>
                            {!! Form::select('customer_id', $customers, null, ['style' => 'width:100%','class' => 'form-control select','placeholder' => '- Pilih Reseller -', 'id' => 'customer_id', 'required']) !!}
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Kuantitas</label>
                            <input type="text" class="form-control" id="qty" name="qty" required>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Tanggal</label>
                            <input data-date-format='yyyy-mm-dd' type="text" class="form-control" id="tanggal" name="tanggal"   required>
                            <span class="help-block with-errors"></span>
                        </div>

                    </div>
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div><!-- Log on to codeastro.com for more projects! -->
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
