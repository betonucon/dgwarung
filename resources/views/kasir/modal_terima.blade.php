    <input type="hidden" name="kategori_keuangan_id" value="2">
    <div class="row">
        
        <div class="col-md-12">
            <div class="form-group row" >
                <label style="padding: 1% 1% 2% 3%;" class="col-lg-5 col-form-label">Jumlah</label>
                <div class="col-lg-5" style="padding: 1% 1% 2% 1%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" readonly  value="{{uang(total_harga_jual($id))}}" id="currency1">
                        <input type="hidden" class="form-control" name="nilai" readonly  value="{{total_harga_jual($id)}}" >
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label style="padding: 1% 1% 2% 3%;" class="col-lg-5 col-form-label">Status Pembayaran</label>
                <div class="col-lg-7" style="padding: 1% 1% 2% 1%;">
                    <div class="input-group input-group-sm">
                        <select  name="status_keuangan_id" onchange="pilih_status_keuangan(this.value)" class="form-control form-control-sm" placeholder="Ketik disini....">
                            <option value="1" > Tunai</option>
                            <option value="4"> Tempo</option>
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="form-group row" id="hidden_tanggal_tempo">
                <label style="padding: 1% 1% 2% 3%;" class="col-lg-5 col-form-label">Rencana Pembayaran</label>
                <div class="col-lg-5" style="padding: 1% 1% 2% 1%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="tanggal" readonly  id="tanggalnya" placeholder="yyyy-mm-dd">
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
            if(id==4){
                $("#hidden_tanggal_tempo").show();
            }else{
                $("#hidden_tanggal_tempo").hide();
            }
        }
    </script>