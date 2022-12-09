    <input type="hidden" name="kategori_keuangan_id" value="2">
    <div class="row">
        
        <div class="col-md-12">
            <div class="form-group row" >
                <label style="padding: 1% 1% 1% 3%;" class="col-lg-3 col-form-label">Jumlah</label>
                <div class="col-lg-4" style="padding: 1% 1% 1% 1%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" readonly  value="{{uang(total_harga_jual($id))}}" id="currency1">
                        <input type="hidden" class="form-control" name="nilai" readonly  value="{{total_harga_jual($id)}}" >
                        <input type="hidden" class="form-control" name="nilai_beli" readonly  value="{{total_harga_beli($id)}}" >
                        <input type="hidden" class="form-control" name="provite" readonly  value="{{total_harga_provite($id)}}" >
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label style="padding: 1% 1% 1% 3%;" class="col-lg-3 col-form-label">Status Pembayaran</label>
                <div class="col-lg-3" style="padding: 1% 1% 1% 1%;">
                    <div class="input-group input-group-sm">
                        <select  name="status_keuangan_id" onchange="pilih_status_keuangan(this.value)" class="form-control form-control-sm" placeholder="Ketik disini....">
                            <option value="1" > Tunai</option>
                            <option value="4"> Tempo</option>
                        </select>
                        
                    </div>
                </div>
            </div>
            <div class="form-group row" id="hidden_tanggal_tempo">
                <label style="padding: 1% 1% 1% 3%;" class="col-lg-3 col-form-label">Rencana Pembayaran</label>
                <div class="col-lg-2" style="padding: 1% 1% 1% 1%;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" name="tanggal" readonly  id="tanggalnya" placeholder="yyyy-mm-dd">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="table-responsive" style="height:200px">
                    <table class="table table-bordered m-b-0">
                        <thead>
                            <tr>
                                <th style="background:aqua" width="5%">No</th>
                                <th style="background:aqua">Barang</th>
                                <th style="background:aqua" width="20%">Harga</th>
                                <th style="background:aqua" width="10%">Qty</th>
                                <th style="background:aqua" width="10%">Stok</th>
                                <th style="background:aqua" width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $totready=0;
                            ?>
                            @foreach($get as $no=>$g)
                            <tr>
                                <td>{{$no+1}}</td>
                                <td>{{$g->nama_barang}} ({{$g->keterangan}})</td>
                                <td style="text-align:right">{{uang($g->harga_jual)}}</td>
                                <td>{{$g->qty}}</td>
                                <td>{{$g->sisa}}</td>
                                <td>
                                    @if($g->sisa>=$g->qty)
                                        <?php $totready+=1; ?>
                                        <font color="blue"><b>Ok</b></font>
                                    @else
                                        <font color="red"><b>No</b></font>
                                        <?php $totready+=0; ?>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="ready" value="{{$totready}}">
                <input type="hidden" name="count" value="{{$count}}">
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