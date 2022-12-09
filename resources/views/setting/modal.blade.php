        <input type="hidden" name="id" value="{{$id}}">
        @if($id==1)  
            <div class="row">
                
                <div class="col-md-12">
                    <div class="form-group row">
                        <label style="padding: 0% 1% 0% 3%;" class="col-lg-5 col-form-label">Penentuan Provit</label>
                        <div class="col-lg-7" style="padding: 0% 1% 0% 0%;">
                            <div class="input-group input-group-sm">
                                <select  name="setting_int" onchange="pilih_provite(this.value)" class="form-control form-control-sm" placeholder="Ketik disini....">
                                    <option value="1" @if($data->setting_int==1) selected @endif >Berdasarkan Persentase</option>
                                    <option value="2" @if($data->setting_int==2) selected @endif >Manual</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="hidden_provit">
                        <label style="padding: 0% 1% 0% 3%;" class="col-lg-5 col-form-label">Value %</label>
                        <div class="col-lg-2" style="padding: 0% 1% 0% 0%;">
                            <div class="input-group input-group-sm">
                                <input type="text"  name="setting_int_value" id="currency1"  value="{{$data->setting_int_value}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                                
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                
            </div>
        @endif
        @if($id==2)  
            <div class="row">
                
                <div class="col-md-12">
                    <div class="form-group row">
                        <label style="padding: 0% 1% 0% 3%;" class="col-lg-5 col-form-label">Penggunaan Stok</label>
                        <div class="col-lg-7" style="padding: 0% 1% 0% 0%;">
                            <div class="input-group input-group-sm">
                                <select  name="setting_int"  class="form-control form-control-sm" placeholder="Ketik disini....">
                                    <option value="1" @if($data->setting_int==1) selected @endif >Otomatis FIFO</option>
                                    <option value="2" @if($data->setting_int==2) selected @endif >Pilih Manual Manual</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
                
            </div>
        @endif
        @if($id==4)  
            <div class="row">
                
                <div class="col-md-12">
                    <div class="form-group row">
                        <label style="padding: 0% 1% 0% 3%;" class="col-lg-5 col-form-label">Aktivasi Aplikasi</label>
                        <div class="col-lg-7" style="padding: 0% 1% 0% 0%;">
                            <div class="input-group input-group-sm">
                                <select  name="setting_int"  class="form-control form-control-sm" placeholder="Ketik disini....">
                                    <option value="1" @if($data->setting_int==1) selected @endif >Aktif</option>
                                    <option value="2" @if($data->setting_int==2) selected @endif >Non Aktif</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
                
            </div>
        @endif
        @if($id==6)  
            <div class="row">
                
                <div class="col-md-12">
                    <div class="form-group row">
                        <label style="padding: 0% 1% 0% 3%;" class="col-lg-5 col-form-label">Penentuan Harga Jual</label>
                        <div class="col-lg-7" style="padding: 0% 1% 0% 0%;">
                            <div class="input-group input-group-sm">
                                <select  name="setting_int"  class="form-control form-control-sm" placeholder="Ketik disini....">
                                    <option value="1" @if($data->setting_int==1) selected @endif >Master Barang</option>
                                    <option value="2" @if($data->setting_int==2) selected @endif >Stok Barang</option>
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
                
            </div>
        @endif
        @if($id==3)  
            <div class="row">
                
                <div class="col-md-12">
                    <div class="form-group row">
                        <label style="padding: 0% 1% 0% 3%;" class="col-lg-5 col-form-label">Ukuran Font (PX)</label>
                        <div class="col-lg-7" style="padding: 0% 1% 0% 0%;">
                            <div class="input-group input-group-sm">
                                <select  name="setting_int"  class="form-control form-control-sm" placeholder="Ketik disini....">
                                    @for($x=11;$x<24;$x++)
                                        <option value="{{$x}}" @if($data->setting_int==$x) selected @endif >{{$x}}PX</option>
                                    @endfor
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
                
            </div>
        @endif
        @if($id==5)  
            <div class="row">
                
                <div class="col-md-12">
                    <div class="form-group row">
                        <label style="padding: 0% 1% 0% 3%;" class="col-lg-5 col-form-label">Item perhalaman cetak</label>
                        <div class="col-lg-7" style="padding: 0% 1% 0% 0%;">
                            <div class="input-group input-group-sm">
                                <select  name="setting_int"  class="form-control form-control-sm" placeholder="Ketik disini....">
                                    @for($x=10;$x<24;$x++)
                                        <option value="{{$x}}" @if($data->setting_int==$x) selected @endif >{{$x}} Item</option>
                                    @endfor
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
                
            </div>
        @endif

        <script> 

            $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });



            @if($id==1 && $data->setting_int==1)
                $('#hidden_provit').show();
            @else
                $('#hidden_provit').hide();
            @endif
            function pilih_provite(id){
                if(id==1){
                    $('#hidden_provit').show();
                }else{
                    $('#hidden_provit').hide();
                }
            }
        </script> 