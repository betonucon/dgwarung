
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
            @if($id==0)
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Kategori</label>
                <div class="col-lg-6" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <select name="kategori_keuangan_id" onchange="cari_stok(this.value)" class="form-control form-control-sm " id="default-select2" placeholder="Ketik disini....">
                           
                            <option value="">Pilih Kategori</option>
                            @foreach(get_katkeuangan() as $ket)
                                <option value="{{$ket->id}}" @if($ket->id==$data->kategori_keuangan_id) selected @endif >{{$ket->keterangan}}</option>
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
                        <select name="status_keuangan_id" class="form-control form-control-sm " id="tampil_status" placeholder="Ketik disini....">
                           
                            <option value="">Pilih Status</option>
                            
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
            <div class="form-group row" id="nilai_uang">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Nilai</label>
                
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"    name="nilai" id="nilai"  value="{{$data->nilai}}"  class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                
            </div>
            <div  id="nilai_gaji">
                <div class="form-group row" >
                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Periode Bulan & Tahun</label>
                    
                    <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                        <div class="input-group input-group-sm">
                            <select name="bulan_gaji" class="form-control form-control-sm " id="tampil_status" placeholder="Ketik disini....">
                            
                            <option value="">Pilih Bulan</option>
                            @for($b=1;$b<13;$b++)
                                <option value="{{ubah_bulan($b)}}" >{{bulan(ubah_bulan($b))}}</option>
                            @endfor
                            
                        </select>
                            
                        </div>
                    </div>
                    <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                        <div class="input-group input-group-sm">
                            <input type="number"    name="tahun_gaji" id="tahun_gaji"  value=""  class="form-control form-control-sm" placeholder="Ketik disini...." />
                            
                        </div>
                    </div>
                    
                </div>
                <div class="form-group row" >
                    <div class="table-responsive" style="height:200px">
                        <table class="table table-bordered m-b-0">
                            <thead>
                                <tr>
                                    <th style="background:aqua" width="5%">No</th>
                                    <th style="background:aqua">Nama</th>
                                    <th style="background:aqua" width="20%">U.Harian</th>
                                    <th style="background:aqua" width="13%">J.Hari</th>
                                    <th style="background:aqua" width="20%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(get_employe() as $no=>$g)
                                <tr>
                                    <td>{{$no+1}}</td>
                                    <td>{{$g->nama}}</td>
                                    <td style="text-align:right">
                                        <input type="hidden" id="gaji{{$g->id}}" name="gaji{{$g->id}}" value="{{$g->gaji}}">
                                        <input type="hidden" id="nik{{$g->id}}"  name="nik{{$g->id}}" value="{{$g->nik}}">
                                        {{uang($g->gaji)}}
                                    </td>
                                    <td><input type="number" name="hari{{$g->id}}" class="form-control form-control-sm" onkeyup="tentukan_gaji(this.value,{{$g->id}})" value="0"></td>
                                    <td><input type="number" name="total{{$g->id}}" class="form-control form-control-sm" id="total_gaji{{$g->id}}" value="0"></td>
                                    
                                    
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Nomor Keuangan</label>
                
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" disabled  name="nomor" value="{{$data->nomor}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Keterangan</label>
                
                <div class="col-lg-9" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"  name="keterangan" value="{{$data->keterangan}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                        <input type="hidden"  name="kategori_keuangan_id" value="{{$data->kategori_keuangan_id}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                
            </div>
            
            
                
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Nilai</label>
                
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"    name="nilai" id="nilai"  value="{{$data->nilai}}"  class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                
            </div>
                
            @endif
            
            
            
            
        </div>
        
        
    </div>

    <script>
        
            $("#nilai_uang").hide();
            $("#nilai_gaji").hide();

        
        
        $("#default-select2").select2();
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#currency2").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#nilai").inputmask({ alias : "currency", prefix: '', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#qty_retur").inputmask({ alias : "currency", prefix: '', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        
        $('#tanggal').datepicker({
            format:"yyyy-mm-dd",
            autoclose: true
        });
        function tentukan_gaji(hari,no){
            var gaji=$('#gaji'+no).val();
            var total=gaji*hari;
               $('#total_gaji'+no).val(total);
        }
        function cari_stok(id){
            $.ajax({
                type: 'GET',
                url: "{{url('keuangan/tentukan_status')}}",
                data: "kategori_keuangan_id="+id,
                success: function(msg){
                    $('#tampil_status').html(msg);
                }
            });
            if(id==5){
                $("#nilai_gaji").show();
                $("#nilai_uang").hide();
            }else{
                $("#nilai_gaji").hide();
                $("#nilai_uang").show();
            }
        }
        
        
    </script>