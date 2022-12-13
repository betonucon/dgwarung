
    <input type="hidden" name="ide" value="{{$ide}}">
    <div class="row">
        
        <div class="col-md-9">
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Kode BR/Nama Barang</label>
                <div class="col-lg-6" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <select name="kode" onchange="cari_barang(this.value)" class="form-control form-control-sm " id="default-select2" placeholder="Ketik disini....">
                           
                            <option value="">Cari Nama Barang</option>
                            
                            @foreach(get_barang() as $sat)
                                <option value="{{$sat->kode}}" @if($data->kode==$sat->kode) selected @endif >[{{$sat->kode}}] {{$sat->nama_barang}} ({{$sat->satuan}})</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"  disabled  name="satuan" id="satuan" value="{{$data->satuan}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Harga Dasar / Discon</label>
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="harga_dasar" value="{{$data->harga_dasar}}"   id="harga_dasar" placeholder="Discon">
                    </div>
                </div>
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="discon" id="discon" value="{{$data->discon}}"  placeholder="%">
                    </div>
                </div>
                
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Harga Beli / Jual</label>
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="harga_beli" value="{{$data->harga_beli}}"  onkeyup="tentukan_provit(this.value)" id="currency1" placeholder="999/99/9999">
                    </div>
                </div>
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="harga_jual" value="{{$data->harga_jual}}" @if(setting_provit()==1) readonly @endif id="currency2" placeholder="999/99/9999">
                    </div>
                </div>
                
                
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Qty & Expired</label>
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="qty" value="{{$data->qty}}" id="qty"  @if($order->status==0) onkeypress="proses_enter(event)" @endif placeholder="0">
                    </div>
                </div>
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="expired" readonly value="{{$data->expired}}"  @if($order->status==0) onkeypress="proses_enter(event)" @endif id="tanggal" placeholder="yyyy-mm-dd">
                    </div>
                </div>
                
                
            </div>
            
           
            
        </div>
        <div class="col-md-3" style="height: 95px;padding-top: 3.3%;">
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-5 col-form-label">Tot Barang</label>
                <div class="col-lg-7" style="padding: 0% 1% 0% 0%;border: solid 1px #f7f7ff; background: #e8e8f3;height:30px">
                    <p  style="margin-top: 0; margin-left: 3%; margin-bottom: 0px; line-height: 2.1; font-size: 13px;">{{total_item_stok($id)}} Item</p>
                </div>
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-5 col-form-label">Tot Harga</label>
                <div class="col-lg-7" style="padding: 0% 1% 0% 0%;border: solid 1px #f7f7ff; background: #e8e8f3;height:30px">
                    <p  style="margin-top: 0; margin-left: 3%; margin-bottom: 0px; line-height: 2.1; font-size: 13px;">Rp.{{uang(total_harga_stok($id))}} </p>
                </div>
            </div>
            
            
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <div class="col-lg-8"  style="padding: 1% 1% 0% 1%;">
                    @if($order->status==0)
                        @if($act=='edit')
                            <span class="btn btn-primary btn-sm" onclick="simpan_data()"><i class="fas fa-save"></i> Update</span>
                        @else
                            <span class="btn btn-primary btn-sm" onclick="simpan_data()"><i class="fas fa-save"></i> Tambah</span>
                        @endif
                        <span class="btn btn-success btn-sm" onclick="terima_data()"><i class="fas fa-check-circle"></i> Selesai </span>
                    @else
                    
                    <span class="btn btn-success btn-sm" onclick="data_baru()"><i class="fas fa-plus"></i> Buat Baru </span>
                    <span class="btn btn-success btn-sm" onclick="cetak_data()"><i class="fas fa-print"></i> Print </span>
                    <span class="btn btn-success btn-sm" onclick="download_data()"><i class="fas fa-print"></i> Download </span>
                    @endif
                </div>
            </div>
            
            
        </div>
        
    </div>

    <script>
        $("#default-select2").select2();
        @if($order->status==0)
        $("#default-select2").select2('open');
        @endif
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#currency2").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#qty").inputmask({ alias : "currency", prefix: '', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#harga_dasar").inputmask({ alias : "currency", prefix: '', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#diskon").inputmask({ alias : "currency", prefix: '', 'autoGroup': true, 'digits': 1, 'digitsOptional': false });
        
        $('#tanggal').datepicker({
            format:"yyyy-mm-dd",
            autoclose: true
        });
        function cari_barang(text){
            $.ajax({
                type: 'GET',
                url: "{{url('barang/cari_barang')}}",
                data: "supplier_id={{$order->supplier_id}}&kode="+text,
                success: function(msg){
                    // alert(msg)
                    var bat=msg.split('@');
        
                        $('#satuan').val(bat[1]);
                        $('#currency1').val(bat[3]);
                        $('#currency2').val(bat[2]);
                        $('#discon').val(bat[4]);
                        $('#harga_dasar').val(bat[5]);
                        $("#currency3").focus();
                }
            });
        }
        function tentukan_provit(text){
            @if(setting_provit()==1)
                $.ajax({
                    type: 'GET',
                    url: "{{url('stokorder/tentukan_provit')}}",
                    data: "nilai="+text,
                    success: function(msg){
                        var bat=msg.split('@');
            
                            $('#currency2').val(bat[1]);
                    }
                });
            @endif
        }
    </script>