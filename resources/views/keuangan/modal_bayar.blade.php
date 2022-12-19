
    <input type="hidden" name="id" value="{{$id}}">
    <div class="note note-warning note-with-right-icon m-b-15">
        <div class="note-content text-right">
            <h4><b>Perhatian</b></h4>
            <p>
                Harap inputkan nilai pembayaran piutang dengan benar agar proses perhitungan tidak mengalami kesalahan dalam merekap keuangan
            </p>
        </div>
        <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
    </div>
    <div class="row">
        
        <div class="col-md-12">
            
            
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Nomor Tagihan & Order </label>
                
                <div class="col-lg-4" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"  readonly name="nomor" value="{{$data->nomor}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                <div class="col-lg-4" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text" readonly  name="nomor_stok" value="{{substr($data->nomor,1,11)}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                
            </div>
            
            <div class="form-group row" >
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Nilai Tagihan</label>
                
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"  readonly  name="nilai" id="nilai"  value="{{$data->nilai}}"  class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                
            </div>
            <div class="form-group row">
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Tanggal</label>
                
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"   name="tanggal" id="tanggal" value="{{date('Y-m-d')}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                
            </div>
            <div class="form-group row" >
                <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Nilai Dibayarkan</label>
                
                <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                    <div class="input-group input-group-sm">
                        <input type="text"    name="nilai_dibayarkan" id="nilai_dibayarkan"   class="form-control form-control-sm" placeholder="Ketik disini...." />
                        
                    </div>
                </div>
                
            </div>
            <div class="form-group row">
                <div class="table-responsive" style="height:200px">
                    <table class="table table-bordered m-b-0">
                        <thead>
                            <tr>
                                <th style="background:aqua" width="5%">No</th>
                                <th style="background:aqua">Keterangan</th>
                                <th style="background:aqua" width="20%">Dibayar</th>
                                <th style="background:aqua" width="18%">Waktu</th>
                                <th style="background:aqua" width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $uangmasuk=0;
                            ?>
                            @foreach($riwayat as $no=>$g)
                            <?php
                                $uangmasuk+=$g->nilai;
                            ?>
                            <tr>
                                <td>{{$no+1}}</td>
                                <td>{{$g->keterangan}}</td>
                                <td style="text-align:right">{{uang($g->nilai)}}</td>
                                <td>{{$g->tanggal}}</td>
                                <td><span class="btn btn-danger btn-xs" onclick="delete_data_bayar({{$id}},{{$g->id}},{{$g->kategori_keuangan_id}})"><i class="fas fa-window-close text-white"></i></span></td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="uangmasuk" value="{{$uangmasuk}}">
                <input type="hidden" name="kategori_keuangan_id" value="{{$data->kategori_keuangan_id}}">
            </div>
            
            
        </div>
        
        
    </div>

    <script>
        $("#hidde1").hide();
        $("#default-select2").select2();
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
        $("#nilai_dibayarkan").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
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