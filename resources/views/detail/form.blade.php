<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form  id="form-item" method="post" action="/detailStore" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>


                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    
                    <div class="box-body">
                        
                        <input type="hidden" name="product_id" id="product_id" value="{{ $produk->id }}">

                        <div class="form-group">
                            <label >Warna</label><br>
                            <select name="warna_id" id="warna_id" class="form-control select" style="width: 100%">
                                <option value="">- Pilih Warna -</option>
                                @foreach ($warna as $data)
                                    <option value="{{$data->id}}">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {{$data->warna}}
                                                </div>
                                            </div>
                                        </div>
                                    </option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Ukuran</label><br>
                            <select name="ukuran_id" id="ukuran_id" class="form-control select" style="width: 100%">
                                <option value="">- Pilih Ukuran -</option>
                                @foreach ($ukuran as $data)
                                    <option value="{{$data->id}}">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {{$data->ukuran}}
                                                </div>
                                            </div>
                                        </div>
                                    </option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>

                        <div class="form-group">
                            <label >Gambar</label><br>
                            <input type="file" class="form-control" id="gambar" name="gambar[]" multiple>
                            <span class="help-block with-errors"></span>
                        </div>

                     
                        <input type="hidden" class="form-control" id="stok" name="stok" value="0" readonly>


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
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
