
    <div class="row">
        
        <div class="col-md-8">
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
                        <input type="text"  disabled  name="satuan" id="satuan" class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Harga Beli & Jual</label>
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" onkeyup="tentukan_provit(this.value)" id="currency1" placeholder="999/99/9999">
                    </div>
                </div>
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" @if(setting_provit()==1) readonly @endif id="currency2" placeholder="999/99/9999">
                    </div>
                </div>
                
            </div>
            
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Satuan</label>
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <select name="satuan" class="form-control form-control-sm" placeholder="Ketik disini....">
                            <option value="">Pilih Satuan</option>
                            @foreach(get_satuan() as $sat)
                                <option value="{{$sat->satuan}}" @if($data->satuan==$sat->satuan) selected @endif >{{$sat->satuan}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                
            </div>
            
        </div>
        <div class="col-md-4">
            
            
            
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <div class="col-lg-8"  style="padding: 1% 1% 0% 1%;">
                    @if($id>0)
                        <span class="btn btn-primary btn-sm" onclick="simpan_data()">Update</span>
                    @else
                        <span class="btn btn-primary btn-sm" onclick="simpan_data()">Tambah</span>
                    @endif
                </div>
            </div>
            
            
        </div>
        
    </div>

    <script>
        $("#default-select2").select2();
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#currency2").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        
        function cari_barang(text){
            $.ajax({
                type: 'GET',
                url: "{{url('barang/cari_barang')}}",
                data: "kode="+text,
                success: function(msg){
                    var bat=msg.split('@');
        
                        $('#satuan').val(bat[1]);
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