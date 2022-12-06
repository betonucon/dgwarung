                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Kode BR</label>
                                    <div class="col-lg-5" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            <input type="text" disabled name="kode" value="{{$data->kode}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                @if($id==0)
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Kategori</label>
                                    <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            <select name="kategori" onchange="cari_kategori(this.value)" class="form-control form-control-sm" placeholder="Ketik disini....">
                                                <option value="1">Baru</option>
                                                <option value="2">Tambah Satuan</option>
                                            </select>
                                        
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row" id="tampil_new">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Nama Barang</label>
                                    <div class="col-lg-8" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            <input type="text"  {{$disabled}}  name="nama_barang" value="{{$data->nama_barang}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="tampil_tambah_satuan">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Nama Barang</label>
                                    <div class="col-lg-8" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            <select name="join_kode"  class="form-control form-control-sm " id="default-select2" placeholder="Ketik disini....">
                                                <option value="">Pilih</option>
                                                @foreach(get_join_kode() as $sat)
                                                    <option value="{{$sat->join_kode}}" > {{$sat->nama_barang}}</option>
                                                @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                @if($id>0)
                                    <div class="form-group row">
                                        <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Satuan</label>
                                        <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                                            <div class="input-group input-group-sm">
                                                <select name="satuannya" class="form-control form-control-sm" placeholder="Ketik disini....">
                                                    <option value="">Pilih Satuan</option>
                                                    @foreach(get_satuan() as $sat)
                                                        <option value="{{$sat->kd_satuan}}" @if($data->kd_satuan==$sat->kd_satuan) selected @endif >{{$sat->satuan}}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                @else
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Satuan</label>
                                    <div class="col-lg-8" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            @foreach(get_satuan() as $sat)
                                                <div class="custom-control custom-checkbox mb-1">
                                                    <input type="checkbox" name="satuan[]" value="{{$sat->kd_satuan}}" class="custom-control-input" id="customCheck{{$sat->id}}">
                                                    <label class="custom-control-label" for="customCheck{{$sat->id}}">{{$sat->satuan}}&nbsp;</label>
                                                </div>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Keterangan</label>
                                    <div class="col-lg-8" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group input-group-sm">
                                                <input type="text"  name="keterangan" value="{{$data->keterangan}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Foto Barang</label>
                                    <div class="col-lg-7"  style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm" >
                                            <input type="file" name="file"  class="form-control form-control-sm" placeholder="Ketik disini...." />
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="col-lg-12"  style="padding: 1% 1% 2% 2%;">
                                        @if($id>0)
                                            <span class="btn btn-primary btn-sm" onclick="simpan_data()">Update</span>
                                        @else
                                            <span class="btn btn-primary btn-sm" onclick="simpan_data()">Tambah</span>
                                        @endif
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>

                        <script>
                            $("#default-select2").select2();
                            $("#tampil_tambah_satuan").hide();

                            function cari_kategori(id){
                                if(id==1){
                                    $("#tampil_new").show();
                                    $("#tampil_tambah_satuan").hide();
                                }else{
                                    $("#tampil_new").hide();
                                    $("#tampil_tambah_satuan").show();
                                }
                            }
                        </script>