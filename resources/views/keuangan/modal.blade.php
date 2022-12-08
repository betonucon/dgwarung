
    <input type="hidden" name="id" value="{{$id}}">
    <input type="hidden" name="nomor" value="{{$data->nomor}}">
    <div class="note note-warning note-with-right-icon m-b-15">
        <div class="note-content text-right">
            <h4><b>Perhatian</b></h4>
            <p>
                Jika memilih kategori gaji maka sistem akan menghitung otomatis bedasarkan gaji ketetapan yang ada dimaster pegawai,
                Selain kategori gaji nilai diinputkan secara manual
            </p>
        </div>
        <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
    </div>
    <div class="row">
        
        <div class="col-md-12">
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Kategori</label>
                <div class="col-lg-6" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <select name="kategori_keuangan_id" onchange="cari_stok(this.value)" class="form-control form-control-sm " id="default-select2" placeholder="Ketik disini....">
                           
                            <option value="">Pilih Kategori</option>
                            @foreach(get_katkeuangan() as $ket)
                                <option value="{{$ket->id}}" @if($ket->id==$data->kategori_keuangan_id) selected @endif >{{$ket->kategori_keuangan}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                
            </div>
            
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Keterangan</label>
                
                <div class="col-lg-9" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"  name="keterangan" value="{{$data->keterangan}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Status Keuangan</label>
                <div class="col-lg-4" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <select name="status_keuangan_id" class="form-control form-control-sm " id="default-select2" placeholder="Ketik disini....">
                           
                            <option value="">Pilih Kategori</option>
                            @foreach(get_setkeuangan() as $ket)
                                <option value="{{$ket->id}}" @if($ket->id==$data->status_keuangan_id) selected @endif >{{$ket->status_keuangan}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Tanggal</label>
                
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"   name="tanggal" id="tanggal" value="@if($id==0) {{date('Y-m-d')}} @else {{$data->tanggal}} @endif" class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                
            </div>
            <div class="form-group row" >
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Nilai</label>
                
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"    name="nilai" id="nilai"  value="{{$data->nilai}}"  class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                
            </div>
            
            
            
        </div>
        
        
    </div>

    <script>
        $("#hidde1").hide();
        $("#default-select2").select2();
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#currency2").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#nilai").inputmask({ alias : "currency", prefix: '', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#qty_retur").inputmask({ alias : "currency", prefix: '', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        
        $('#tanggal').datepicker({
            format:"yyyy-mm-dd",
            autoclose: true
        });
        function cari_stok(id){
            if(id==5){
                $("#nilai").val("{{sum_gaji()}}");
            }else{
                $("#nilai").val(0);
            }
        }
        
    </script>