    <input type="hidden" name="kategori_keuangan_id" value="1">
    <div class="row">
        
        <div class="col-md-12">
            <div class="form-group row" >
                <label style="padding: 1% 1% 2% 3%;" class="col-lg-5 col-form-label">Jumlah</label>
                <div class="col-lg-5" style="padding: 1% 1% 2% 1%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" readonly  value="{{uang(total_harga_stok($id))}}" id="currency1">
                        <input type="hidden" class="form-control" name="nilai" readonly  value="{{total_harga_stok($id)}}" >
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label style="padding: 1% 1% 2% 3%;" class="col-lg-5 col-form-label">Status Pembayaran</label>
                <div class="col-lg-7" style="padding: 1% 1% 2% 1%;">
                    <div class="input-group input-group-sm">
                        <select  name="status_keuangan_id" onchange="pilih_status_keuangan(this.value)" class="form-control form-control-sm" placeholder="Ketik disini....">
                            <option value="3" >Piutang</option>
                            <option value="2">Cash</option>
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
                swal({
                    title: "Yakin menggunakan pembayaran cash ?",
                    text: "Periksa kembali jika iya silahkan lanjutkan",
                    type: "info",
                    icon: "info",
                    showCancelButton: true,
                    align:"center",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }).then((willDelete) => {
                   
                });
                $("#hidden_tanggal_tempo").hide();
            }
        }
    </script>