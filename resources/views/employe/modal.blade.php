                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">NIK</label>
                                    <div class="col-lg-6" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            <input type="text"  name="nik" value="{{$data->nik}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Nama</label>
                                    <div class="col-lg-7" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            <input type="text"  name="nama" value="{{$data->nama}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Alamat</label>
                                    <div class="col-lg-9" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            <input type="text"  name="alamat" value="{{$data->alamat}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">No Telpon</label>
                                    <div class="col-lg-3" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            <input type="text"  name="no_telepon" value="{{$data->no_telepon}}" class="form-control form-control-sm" placeholder="Ketik disini...." />
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Harian</label>
                                    <div class="col-lg-4" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            <input type="text"  name="gaji" value="{{$data->gaji}}" id="gaji" class="form-control form-control-sm" placeholder="Ketik disini...." />
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Uang Makan</label>
                                    <div class="col-lg-4" style="padding: 0% 1% 0% 0%;">
                                        <div class="input-group input-group-sm">
                                            <input type="text"  name="uang_makan" value="{{$data->uang_makan}}" id="uang_makan" class="form-control form-control-sm" placeholder="Ketik disini...." />
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                        </div>
                        <script>
                            $("#gaji").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
                            $("#uang_makan").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false });
                        </script>