@extends('layouts.web_top')

@section('content')
<div id="content" class="content">
    <!-- begin page-header -->
    <h1 class="page-header">Selamat Datang {{Auth::user()->name}}<small></small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-xl-12">
            <a href="#" class="widget-card widget-card-rounded m-b-20" data-id="widget">
                <div class="widget-card-cover" style="background-image: url({{url_plug()}}/assets/img/gallery/gallery-portrait-11-thumb.jpg?v={{date('ymdhis')}})"></div>
                <div class="widget-card-content">
                    <b class="text-white">Pelayanan Berbasis Online Lingkungan Kel Deringo</b>
                </div>
                <div class="widget-card-content bottom">
                    <img src="{{url_plug()}}/img/cilegon.png" width="30%" alt="" /> 
                    <h4 class="text-white m-t-10"><b>KELURAHAN DERINGO - CITANGKIL</b></h4>
                    <h5 class="f-s-12 text-white-transparent-7 m-b-2"><b>KOTA CILEGON</b></h5>
                </div>
            </a>
        </div>
        <div class="col-xl-5">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Profil</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <img src="{{url_plug()}}/img/akun.png" width="100%" alt="" /> 
                            
                        </div>
                        <div class="col-xs-8">
                                <div class="widget-list-item">
									<div class="widget-list-content">
										<p style="margin-bottom:1.4%;width:100%;background:#e8e8ed;padding:1%" class="widget-list-desc"><b>NIK :</b> {{warga()->nik}}</p>
										<p style="margin-bottom:1.4%;width:100%;background:#e8e8ed;padding:1%" class="widget-list-desc"><b>NO KK :</b> {{warga()->no_kk}}</p>
                                        <p style="margin-bottom:1.4%;width:100%;background:#e8e8ed;padding:1%" class="widget-list-desc"><b>NAMA :</b> {{warga()->nama}}</p>
                                        <p style="margin-bottom:1.4%;width:100%;background:#e8e8ed;padding:1%" class="widget-list-desc"><b>RT/RW :</b> {{warga()->rt}}/{{warga()->rw}}</p>
                                        <p style="margin-bottom:1.4%;width:100%;background:#e8e8ed;padding:1%" class="widget-list-desc"><b>TTGL :</b> {{warga()->tempat_lahir}}, {{warga()->tanggal_lahir}}</p>
                                        <p style="margin-bottom:1.4%;width:100%;background:#e8e8ed;padding:1%" class="widget-list-desc"><b>J KELAMIN :</b> {{kelamin(warga()->j_kelamin)}}</p>
									</div>
									
								</div>
                        </div>
                    </div>
                
                </div>
                <!-- end panel-body -->
            </div>
            <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Pelayanan</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach(get_pelayanan() as $pel)
                                <a href="{{url('pelayananuser/'.$pel->tipe.'/create')}}" class="btn btn-primary btn-block">{{$pel->pelayanan}}</a>
                            @endforeach
                            
                        </div>
                        
                    </div>
                
                </div>
                <!-- end panel-body -->
            </div>
            <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Pengaduan</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="row">
                        <form  id="mydata" style="width:100%" class="form-horizontal form-bordered" method="post" action="{{ url('pengaduan') }}" enctype="multipart/form-data" >
                            @csrf 
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Kategori Pengaduan</label>
                                <div class="col-lg-8">
                                    <select name="kategori_pengaduan_id" class="form-control">
                                        <option value="">Pilih------</option>
                                        @foreach(get_mpengaduan() as $mp)
                                            <option value="{{$mp->id}}">{{$mp->kategori_pengaduan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Lampiran</label>
                                <div class="col-lg-8">
                                    <input type="file" name="file"  class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Deskripsi Pengaduan</label>
                                <div class="col-lg-8">
                                    <textarea name="deskripsi" rows="5" class="form-control" placeholder="ketik disini...." ></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label"><span class="btn btn-sm btn-primary" id="save-data" >Kirim Pengaduan</span></label>
                                <div class="col-lg-8">
                                    
                                </div>
                            </div>
                            
                        </form>
                    </div>
                
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        <div class="col-xl-7">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Pengumuman</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="slimScrollDiv">
                        <ul class="media-list media-list-with-divider">
                            @foreach($data as $o)
                            <li class="media media-lg">
                                <div class="media-body">
                                    <h5 class="media-heading">{{$o->judul}}</h5>
                                    <div style="height:90px;overflow:hidden">{!! $o->deskripsi !!}</div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>
    <!-- end row -->
</div>
@endsection

@push('ajax')

    <script>
        $('#save-data').on('click', () => {
            
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{ url('pengaduan') }}",
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
                            $('#modal-import').modal('hide');
                            document.getElementById("loadnya").style.width = "0px";
                            swal({
									title: "Success! berhasil disimpan!",
									icon: "success",
                            });
                            location.assign("{{url('pengaduan/view_user')}}?nomor_pengaduan="+bat[2])
                                
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
                        }
                        
                        
                    }
                });
        });
    </script>
@endpush