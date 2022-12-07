@extends('layouts.web')
@push('style')
    <style>
        th {
            font-size: 12px !important;
            font-family: sans-serif;
        }
        td {
            font-size: 12px !important;
            font-family: sans-serif;
        }
    </style>
@endpush
@section('content')
<div id="content" class="content">
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">&nbsp;</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body panel-form">
                    <form class="form-horizontal form-bordered" style="padding:1%;background: #c1c1c5;" id="mydata" method="post" action="{{ url('warga') }}" enctype="multipart/form-data" >
                        @csrf 
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="row" style="background:#fff;margin-left:0.1%;margin-right:0.1%;margin-bottom:2%;padding: 1% 1% 1% 0%; border-radius: 5px;">
        
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 1%;" class="col-lg-2 col-form-label">Kode BR</label>
                                    <div class="col-lg-2" style="padding: 0% 1% 0% 1%;">{{$data->kode}}</div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 1%;" class="col-lg-2 col-form-label">Nama Barang</label>
                                    <div class="col-lg-2" style="padding: 0% 1% 0% 1%;">{{$data->nama_barang}}</div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 1%;" class="col-lg-2 col-form-label">Satuan</label>
                                    <div class="col-lg-2" style="padding: 0% 1% 0% 1%;">{{$data->satuan}}/{{$data->kd_satuan}}</div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 1%;" class="col-lg-2 col-form-label">Keterangan</label>
                                    <div class="col-lg-2" style="padding: 0% 1% 0% 1%;">{{$data->keterangan}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-left:0.1%;margin-right:0.1%;margin-bottom:2%;">

        
                            <div class="col-md-12" style="padding:0px">
                                <div class="btn-group btn-group-justified">
                                    <a class="btn btn-blue text-white" onclick="retur_data()"><i class="fas fa-backward"></i> Retur</a>
                                    <a class="btn btn-green text-white" onclick="tukar_data()"><i class="fas fa-backward"></i> Tukar</a>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="{{url('stok/view')}}?kode={{$kode}}" class="nav-link @if($act==0) active @endif">
                                    <span class="d-sm-none">Tersedia</span>
                                    <span class="d-sm-block d-none">Stok Tersedia {{$act}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a  href="{{url('stok/view')}}?kode={{$kode}}&act=2"  class="nav-link  @if($act==2) active @endif">
                                    <span class="d-sm-none">Order</span>
                                    <span class="d-sm-block d-none">Order</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a  href="{{url('stok/view')}}?kode={{$kode}}&act=3"  class="nav-link  @if($act==3) active @endif">
                                    <span class="d-sm-none">Terjual</span>
                                    <span class="d-sm-block d-none">Terjual</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a  href="{{url('stok/view')}}?kode={{$kode}}&act=4"  class="nav-link  @if($act==4) active @endif">
                                    <span class="d-sm-none">Retur</span>
                                    <span class="d-sm-block d-none">Retur</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a  href="{{url('stok/view')}}?kode={{$kode}}&act=5"  class="nav-link  @if($act==5) active @endif">
                                    <span class="d-sm-none">Tukar</span>
                                    <span class="d-sm-block d-none">Tukar</span>
                                </a>
                            </li>
                            
                        </ul>
                        <!-- end nav-tabs -->
                        <!-- begin tab-content -->
                        <div class="tab-content">
                           
                                <div class="tab-pane fade active show " id="default-tab-1">
                                    <div class="table-responsive ">
                                        
                                        <table id="data-table-fixed-sisa" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-nowrap" width="3%">No</th>
                                                    <th class="text-nowrap" width="10%">Kode</th>
                                                    <th class="text-nowrap">Nama Barang</th>
                                                    <th class="text-nowrap"  width="7%">Satuan</th>
                                                    <th class="text-nowrap"  width="7%">Qty</th>
                                                    <th class="text-nowrap"  width="11%">Status</th>
                                                    <th class="text-nowrap"  width="12%">Waktu</th>
                                                </tr>
                                            </thead>
                                            
                                        </table>
                                    </div>
                                    
                                </div>
                            
                        </div> 
                        <div class="col-xl-12" style="margin-bottom:1%;text-align:center">
                            <a href="javascript:;"  class="btn btn-success btn-sm" onclick="location.assign(`{{url('stok')}}`)"><i class="fas fa-plus"></i> Kembali</a>
                        </div>  
                    </form>
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>
    <!-- end row -->
</div>

<div class="modal fade" id="modal-retur" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <!-- <div class="alert alert-danger m-b-0" id="notifikasiimport">
                    <div id="notifikasi-import"></div>
                    
                </div> -->
                <form class="form-horizontal form-bordered" style="margin-bottom: 1%; padding: 1% 0 1% 0;" id="mydataretur" method="post" action="{{ url('stokorder/store_retur') }}" enctype="multipart/form-data" >
                    @csrf 
                    <input type="text" name="kode" value="{{$kode}}">
                    <div id="tampil-form-retur"></div>
                 </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" onclick="simpan_retur()" >Proses</a>
            </div>
        </div>
    </div>
</div>  

<div class="modal fade" id="modal-tukar" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <!-- <div class="alert alert-danger m-b-0" id="notifikasiimport">
                    <div id="notifikasi-import"></div>
                    
                </div> -->
                <form class="form-horizontal form-bordered" style="margin-bottom: 1%; padding: 1% 0 1% 0;" id="mydatatukar" method="post" action="{{ url('stokorder/store_tukar') }}" enctype="multipart/form-data" >
                    @csrf 
                    <input type="text" name="kode" value="{{$kode}}">
                    <div id="tampil-form-tukar"></div>
                 </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" onclick="simpan_tukar()" >Proses</a>
            </div>
        </div>
    </div>
</div>   
@endsection

@push('ajax')
<script type="text/javascript">
        /*
        Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
        Version: 4.6.0
        Author: Sean Ngu
        Website: http://www.seantheme.com/color-admin/admin/
        */
       
            $('#data-table-fixed-sisa').DataTable({
                lengthMenu: [20],
                fixedHeader: {
                    header: true,
                    headerOffset: $('#header').height()
                },
                responsive: false,
                ajax:"{{ url('stok/get_data_even')}}?kode={{$kode}}&even={{$act}}",
                columns: [
                    { data: 'kode', render: function (data, type, row, meta) 
                        {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        } 
                    },
                    { data: 'kode' },
                    { data: 'nama_barang' },
                    { data: 'satuan' },
                    { data: 'qty' },
                    { data: 'status_data' },
                    { data: 'update' },
                    
                ]
            });

            function retur_data(){
                $('#modal-retur .modal-title').text('Retur Barang ');
                $('#modal-retur').modal('show');
                $('#tampil-form-retur').load("{{url('stokorder/modal_retur')}}?kode={{$kode}}")
            }
            function tukar_data(){
                $('#modal-tukar .modal-title').text('Tukar Satuan Barang ');
                $('#modal-tukar').modal('show');
                $('#tampil-form-tukar').load("{{url('stokorder/modal_tukar')}}?kode={{$kode}}")
            }

            function simpan_retur(){
            
                var form=document.getElementById('mydataretur');
                
                    
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('stokorder/store_retur') }}",
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
                                document.getElementById("loadnya").style.width = "0px";
                                swal({
                                        title: "Success! berhasil disimpan!",
                                        icon: "success",
                                });
                                location.reload();    
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
            };       
            function simpan_tukar(){
            
                var form=document.getElementById('mydatatukar');
                
                    
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('stokorder/store_tukar') }}",
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
                                document.getElementById("loadnya").style.width = "0px";
                                swal({
                                        title: "Success! berhasil diproses!",
                                        icon: "success",
                                });
                                location.reload();    
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
            };       
    </script>
@endpush
