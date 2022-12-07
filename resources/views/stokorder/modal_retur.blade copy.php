
    <input type="hidden" name="kode" value="{{$kode}}">
    <div class="row">
        
        <div class="col-md-12">
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-2 col-form-label">Nomor Stok</label>
                <div class="col-lg-6" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <select name="kode" onchange="cari_stok(this.value)" class="form-control form-control-sm " id="default-select2" placeholder="Ketik disini....">
                           
                            <option value="">Pilih Stok</option>
                            
                            @foreach($data as $sat)
                                <option value="{{$sat->nomor_stok}}" >[{{$sat->nomor_stok}}] {{$sat->msupplier['supplier']}} ({{$sat->qty}})</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-2 col-form-label">Qty</label>
                
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"  readonly  name="qty_awal" id="qty"  class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"  readonly  name="satuan_awal" id="satuan"  class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-2 col-form-label"></label>
                
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"  readonly  name="satuan" id="qty"  class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"  readonly  name="satuan" id="satuan"  class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
            </div>
            
        </div>
        
        
    </div>

    <script>
        $("#default-select2").select2();
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#currency2").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#currency3").inputmask({ alias : "currency", prefix: '', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        
        $('#tanggal').datepicker({
            format:"yyyy-mm-dd",
            autoclose: true
        });
        function cari_stok(text){
            $.ajax({
                type: 'GET',
                url: "{{url('stokorder/cari_stok')}}",
                data: "kode={{$kode}}&nomor_stok="+text,
                success: function(msg){
                    var bat=msg.split('@');
        
                        $('#satuan').val(bat[1]);
                        $('#qty').val(bat[2]);
                }
            });
        }
        
    </script>