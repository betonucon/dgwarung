    <input type="hidden" name="id" value="{{$id}}">
    <div class="row">
        
        <div class="col-md-12">
            <div class="form-group row" >
                <label style="padding: 1% 1% 2% 3%;" class="col-lg-3 col-form-label">Barang</label>
                <div class="col-lg-9 style="padding: 1% 1% 2% 1%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" readonly  value="{{$data->nama_barang}} ({{$data->keterangan}})">
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <label style="padding: 1% 1% 2% 3%;" class="col-lg-3 col-form-label">Harga Beli</label>
                <div class="col-lg-5" style="padding: 1% 1% 2% 1%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" disabled name="harga_beli"   id="currency2" value="{{$data->harga_beli}}">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label style="padding: 1% 1% 2% 3%;" class="col-lg-3 col-form-label">Harga Jual</label>
                <div class="col-lg-5" style="padding: 1% 1% 2% 1%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="harga_jual"   id="currency1" value="{{$data->harga_jual}}">
                    </div>
                </div>
            </div>
            
            
            
        </div>
        
    </div>

    <script>
        $("#hidden_tanggal_tempo").hide();
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#currency2").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#currency3").inputmask({ alias : "currency", prefix: '', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        
        $('#tanggalnya').datepicker({
            format:"yyyy-mm-dd",
            autoclose: true
        });

        function pilih_status_keuangan(id){
            if(id==3){
                $("#hidden_tanggal_tempo").show();
            }else{
                $("#hidden_tanggal_tempo").hide();
            }
        }
    </script>