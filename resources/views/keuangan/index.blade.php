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
                    <form class="form-horizontal form-bordered" style="padding:1%;background: #c1c1c5;"  method="post" action="{{ url('warga') }}" enctype="multipart/form-data" >
                        @csrf 
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="row" style="background:#fff;margin-left:0.1%;margin-right:0.1%;margin-bottom:2%;padding: 1% 1% 1% 0%; border-radius: 5px;">
        
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 1%;" class="col-lg-12 col-form-label">REKAPAN KEUANGAN</label>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Pemasukan</label>
                                    <div class="col-lg-5" style="padding: 0% 1% 0% 1%;">{{uang(keuangan_total(1))}}</div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Pengeluaran</label>
                                    <div class="col-lg-5" style="padding: 0% 1% 0% 1%;">{{uang(keuangan_total(2))}}</div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Piutang</label>
                                    <div class="col-lg-5" style="padding: 0% 1% 0% 1%;">{{uang(keuangan_total(3))}}</div>
                                </div>
                               
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 1%;" class="col-lg-12 col-form-label">ESTIMASI PENJUALAN</label>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Modal</label>
                                    <div class="col-lg-5" style="padding: 0% 1% 0% 1%;">{{uang(keuangan_estimasi(1))}}</div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Sub Penjualan</label>
                                    <div class="col-lg-5" style="padding: 0% 1% 0% 1%;">{{uang(keuangan_estimasi(2))}}</div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Provite</label>
                                    <div class="col-lg-2" style="padding: 0% 1% 0% 1%;">{{uang(keuangan_estimasi(3))}}</div>
                                </div>
                               
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 1%;" class="col-lg-12 col-form-label">AKTUAL PENJUALAN</label>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Modal</label>
                                    <div class="col-lg-5" style="padding: 0% 1% 0% 1%;">{{uang(keuangan_aktual(1))}}</div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Sub Penjualan</label>
                                    <div class="col-lg-5" style="padding: 0% 1% 0% 1%;">{{uang(keuangan_aktual(2))}}</div>
                                </div>
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-4 col-form-label">Provite</label>
                                    <div class="col-lg-2" style="padding: 0% 1% 0% 1%;">{{uang(keuangan_aktual(3))}}</div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="row" style="margin-left:0.1%;margin-right:0.1%;margin-bottom:2%;">

        
                            <div class="col-md-12" style="padding:0px">
                                <div class="btn-group btn-group-justified">
                                    <a class="btn btn-blue text-white" onclick="tambah_data(0)"><i class="fas fa-plus"></i> Tambah</a>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="{{url('keuangan')}}?act=0" class="nav-link @if($act==0) active @endif">
                                    <span class="d-sm-none">All Transaksi</span>
                                    <span class="d-sm-block d-none">All Transaksi</span>
                                </a>
                            </li>
                            @foreach(get_statuskeuangan() as $get)
                            <li class="nav-item">
                                <a  href="{{url('keuangan')}}?act={{$get->id}}"  class="nav-link  @if($act==$get->id) active @endif">
                                    <span class="d-sm-none">{{$get->status_keuangan}}</span>
                                    <span class="d-sm-block d-none">{{$get->status_keuangan}}</span>
                                </a>
                            </li>
                            @endforeach
                            
                        </ul>
                        <!-- end nav-tabs -->
                        <!-- begin tab-content -->
                        <div class="tab-content">
                           
                                <div class="tab-pane fade active show " id="default-tab-1">
                                    <div class="table-responsive ">
                                        
                                        <table id="data-table-fixed-sisa" class="table table-striped table-bordered table-td-valign-middle hover   dt-responsive display nowrap" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-nowrap" width="6%">No</th>
                                                    <th class="text-nowrap" width="10%">Transaksi</th>
                                                    <th class="text-nowrap" width="15%">Kategori</th>
                                                    <th class="text-nowrap">Keterangan</th>
                                                    <th class="text-nowrap"  width="10%">Satus</th>
                                                    <th class="text-nowrap"  width="13%" style="text-align:left !important">Nilai</th>
                                                    <th class="text-nowrap"  width="14%">Waktu</th>
                                                    <th class="text-nowrap"  width="5%"></th>
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
                <form class="form-horizontal form-bordered" style="margin-bottom: 1%; padding: 1% 0 1% 0;" id="mydata" method="post" action="{{ url('keuangan') }}" enctype="multipart/form-data" >
                    @csrf 
                    <div id="tampil-form-retur"></div>
                 </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" onclick="simpan_data()" >Proses</a>
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
                ajax:"{{ url('keuangan/get_data')}}?even={{$act}}",
                columns: [
                    { data: 'kode', render: function (data, type, row, meta) 
                        {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        } 
                    },
                    { data: 'nomor' },
                    { data: 'kategori_keuangan' },
                    { data: 'keterangan' },
                    { data: 'status_keuangan' },
                    { data: 'uang_nilai' ,className: "text-right"  },
                    { data: 'waktu' },
                    { data: 'action' },
                    
                ],
                columnDefs: [
                    {
                        targets: 6,
                        className: 'dt-body-right'
                    }
                ]
            });

            function tambah_data(id){
                $('#modal-retur .modal-title').text('Form Keuangan ');
                $('#modal-retur').modal('show');
                $('#tampil-form-retur').load("{{url('keuangan/modal')}}?id="+id)
            }
            

            function simpan_data(){
            
                var form=document.getElementById('mydata');
                
                    
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('keuangan') }}",
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
