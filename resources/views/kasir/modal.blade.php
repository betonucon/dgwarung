
    <input type="hidden" name="ide" value="{{$ide}}">
    <div class="row">
        
        <div class="col-md-8">
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Nama Barang</label>
                <div class="col-lg-6" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <select name="kode" onchange="cari_barang(this.value)" class="form-control form-control-sm sele2" id="default-select2" placeholder="Ketik disini....">
                           
                            <option value="">Cari Nama Barang</option>
                           
                        </select>
                        
                    </div>
                </div>
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;border: solid 1px #f7f7ff; background: #e8e8f3;">
                   
                        <p id="tampil_nomor_stok" style="margin-top: 0; margin-left: 3%; margin-bottom: 0px; line-height: 2.3; font-size: 14px;">{{$data->nomor_stok}}</p>
                        
                  
                </div>
                
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Harga / Stok</label>
                
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;border: solid 1px #f7f7ff; background: #e8e8f3;height:30px">
                    <p id="tampil_harga_jual" style="margin-top: 0; margin-left: 3%; margin-bottom: 0px; line-height: 2.1; font-size: 13px;">{{$data->harga_jual}}</p>
                </div>
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;border: solid 1px #f7f7ff; background: #e8e8f3;">
                    <p id="tampil_stok" style="margin-top: 0; margin-left: 3%; margin-bottom: 0px; line-height: 2.1; font-size: 13px;">{{stok_ready($data->kode)}} {{$data->satuan}}</p>
                </div>
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;border: solid 1px #f7f7ff; background: #e8e8f3;">
                   
                        <p id="nama_supplier" style="margin-top: 0; margin-left: 3%; margin-bottom: 0px; line-height: 2.3; font-size: 14px;">{{$data->nomor_stok}}</p>
                        
                  
                </div>
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Qty / Discon</label>
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" value="{{$data->qty}}"   @if($order->status==0) onkeypress="proses_enter(event)" @endif  name="qty" id="qty" >
                    </div>
                </div>
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="discon_jual"   @if($order->status==0) onkeypress="proses_enter(event)" @endif  id="diskon" >
                    </div>
                </div>
                
                
            </div>
            
            <input type="hidden" value="{{$data->nomor_stok}}" class="form-control" name="nomor_stok" id="nomor_stok" >
            <input type="hidden" value="{{$data->harga_jual}}" class="form-control" name="harga_jual" id="harga_jual" >
            <input type="hidden" value="{{stok_ready($data->kode)}}" class="form-control" name="stok"  id="stok" >
            <input type="hidden" value="{{$data->satuan}}" name="satuan" id="satuan" class="form-control form-control-sm" placeholder="Ketik disini...." />
            
        </div>
        <div class="col-md-4" style="height: 95px;padding-top: 3.3%;">
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-5 col-form-label">Tot Barang</label>
                <div class="col-lg-7" style="padding: 0% 1% 0% 0%;border: solid 1px #f7f7ff; background: #e8e8f3;height:30px">
                    <p  style="margin-top: 0; margin-left: 3%; margin-bottom: 0px; line-height: 2.1; font-size: 13px;">{{total_item_jual($id)}} Item</p>
                </div>
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-5 col-form-label">Tot Harga</label>
                <div class="col-lg-7" style="padding: 0% 1% 0% 0%;border: solid 1px #f7f7ff; background: #e8e8f3;height:30px">
                    <p  style="margin-top: 0; margin-left: 3%; margin-bottom: 0px; line-height: 2.1; font-size: 13px;">Rp.{{uang(total_harga_jual($id))}} </p>
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
        
        
        $('#default-select2').select2({
            minimumInputLength: 1,
            allowClear: true,
            placeholder: 'Masukan Nama Barang',
            ajax: {
                dataType: 'json',
                url: "{{url('barang/get_data_barang')}}",
                delay: 1000,
                data: function(params) {
                    return {
                    search: params.term
                    }
                },
                processResults: function (data, page) {
                    return {
                        results: data
                    };
                },
            }
        });

        @if($order->status==0)
        $("#default-select2").select2('open');
        @endif
        $("#qty").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#diskon").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#tampil_harga_jual").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#currency3").inputmask({ alias : "currency", prefix: '', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        
        $('#tanggal').datepicker({
            format:"yyyy-mm-dd",
            autoclose: true
        });
        
        function cari_barang(text){
            $.ajax({
                type: 'GET',
                url: "{{url('barang/cari_barang_jual')}}",
                data: "kode="+text,
                success: function(msg){
                    
                    var bat=msg.split('@');
        
                        $('#satuan').val(bat[1]);
                        $('#tampil_stok').html(bat[2]+' '+bat[1]);
                        $('#stok').val(bat[2]);
                        $('#nomor_stok').val(bat[3]);
                        $('#tampil_nomor_stok').html(bat[3]);
                        $('#tampil_harga_jual').html(bat[4]);
                        $('#nama_supplier').html(bat[5]);
                        $('#harga_jual').val(bat[4]);
                        $('#diskon').val(bat[6]);
                        $("#qty").focus();
                }
            });
        }
        function proses_enter(e){
			if(e.keyCode === 13){
                var form=document.getElementById('mydata');
            
                
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('kasir/store_stok') }}",
                        data: new FormData(form),
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function() {
                            document.getElementById("loadnya").style.width = "100%";
                        },
                        success: function(msg){
                            var bat=msg.split('@');
                            if(bat[1]=='ok'){
                                document.getElementById("loadnya").style.width = "0px";
                                
                                $('#satuan').val("");
                                $('#tampil_stok').html("");
                                $('#stok').val(0);
                                $('#nomor_stok').val("");
                                $('#tampil_nomor_stok').html("");
                                $('#tampil_harga_jual').html("");
                                $('#nama_supplier').html("");
                                $('#harga_jual').val(0);
                                $('#diskon').val(0);
                                $('#qty').val(0);
                                $("#default-select2").select2('open');
                                var table=$('#data-table-fixed-header').DataTable();
                                    table.ajax.url("{{ url('kasir/get_data')}}?nomor_stok={{$id}}").load();    
                            }else{
                                document.getElementById("loadnya").style.width = "0px";
                                swal({
                                    title: 'Notifikasi',
                                
                                    html:true,
                                    text:'ss',
                                    icon: 'error',
                                    buttons: {
                                        cancel: {
                                            text: 'Tutup',
                                            value: null,
                                            visible: true,
                                            className: 'btn btn-dangers',
                                            closeModal: true,
                                        },
                                        
                                    }
                                });
                                $('.swal-text').html('<div style="width:100%;background:#f2f2f5;padding:1%;text-align:left;font-size:13px">'+msg+'</div>')
                                $("#qty").val("");
                            }
                            
                            
                        }
                    });
            }
        }
    </script>