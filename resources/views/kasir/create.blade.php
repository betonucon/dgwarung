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
                <div class="panel-body" style="padding: 5px">
                    <form class="form-horizontal form-bordered" style="margin-bottom: 1%; background: ghostwhite; padding: 1% 0 1% 0;" id="mydata" method="post" action="{{ url('kasir/store_stok') }}" enctype="multipart/form-data" >
                        @csrf 
                        <input type="hidden" name="nomor_transaksi" value="{{$id}}">
                        <div class="row">
        
                            <div class="col-md-8">
                                <div class="form-group row">
                                    <label style="padding: 0% 1% 0% 3%;" class="col-lg-3 col-form-label">Nomor Order</label>
                                    <div class="col-lg-3" style="padding: 0% 1% 0% 0%;border: solid 1px #f7f7ff; background: #e8e8f3;">
                                        <p  style="margin-top: 0; margin-left: 3%; margin-bottom: 0px; line-height: 2.1; font-size: 13px;">{{$id}}&nbsp;</p>
                                    </div>
                                    <div class="col-lg-5" style="padding: 0% 1% 0% 0%;border: solid 1px #f7f7ff; background: #e8e8f3;">
                                        <p  style="margin-top: 0; margin-left: 3%; margin-bottom: 0px; line-height: 2.1; font-size: 13px;">Tn. {{$data->konsumen}}&nbsp;</p>
                                    </div>
                                </div>
                             </div>
                        </div>
                        <div id="tampil-form"></div>
                    </form>
                </div>
                <div class="panel-body" style="padding: 0px 8px !important;">       
                    <div>
                        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-nowrap" width="5%">No</th>
                                    <th class="text-nowrap" width="10%">Kode</th>
                                    <th class="text-nowrap">Nama Barang</th>
                                    <th class="text-nowrap"  width="5%" style="text-align:left !important">Qty</th>
                                    <th class="text-nowrap"  width="8%">Satuan</th>
                                    <th class="text-nowrap"  width="9%" style="text-align:left !important">H.Satuan</th>
                                    <th class="text-nowrap"  width="9%" style="text-align:left !important">H.Modal</th>
                                    <th class="text-nowrap"  width="8%" style="text-align:left !important">Diskon</th>
                                    <th class="text-nowrap"  width="10%" style="text-align:left !important">Total</th>
                                    <th class="text-nowrap" width="3%">Act</th>
                                </tr>
                            </thead>
                            
                        </table>
                
                    </div>
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>
    <!-- end row -->
</div>

<div class="modal fade" id="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Transaksi Baru</h4>
                <button type="button" class="close" >×</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" id="mydataorder" method="post" action="{{ url('kasir') }}" enctype="multipart/form-data" >
                    @csrf 
                    <!-- <input type="submit"> -->
                    
                    <div class="form-group">
                        <label>Konsumen</label>
                        <input type="text"  name="konsumen" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Kategori Transaksi</label>
                        <select name="kategori_opname_id" class="form-control form-control-sm "  placeholder="Ketik disini....">
                            @foreach(get_kategoriopname() as $opn)
                                <option value="{{$opn->id}}" >{{$opn->kategori_opname}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" id="tanggaldate"  value="{{date('Y-m-d')}}"  name="tanggal" class="form-control" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" onclick="location.assign(`{{url('kasir')}}`)">Batalkan</a>
                <a href="javascript:;" class="btn btn-primary" onclick="simpan_order()" >Proses</a>
            </div>
        </div>
    </div>
</div>   

<div class="modal fade" id="modal-terima" style="display: none;" aria-hidden="true">
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
                <form class="form-horizontal form-bordered" style="margin-bottom: 1%; padding: 1% 0 1% 0;" id="mydataselesai" method="post" action="{{ url('kasir/store_selesai') }}" enctype="multipart/form-data" >
                    @csrf 
                    <input type="hidden" name="nomor_transaksi" value="{{$id}}">
                    <div id="tampil-form-terima"></div>
                 </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" onclick="simpan_selesai()" >Proses</a>
            </div>
        </div>
    </div>
</div>   
<div class="modal fade" id="modal-cetak" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="height:450px;overflow-y:scroll">
                
                <div id="tampil-form-cetak"></div>
                 
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" onclick="printDiv('tampil-form-cetak','Title')"  ><i class="fas fa-print"></i> Cetak</a>
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
        
        var handleDataTableFixedHeader = function() {
            "use strict";
            
            if ($('#data-table-fixed-header').length !== 0) {
                var table=$('#data-table-fixed-header').DataTable({
                    lengthMenu: [20],
                    fixedHeader: {
                        header: true,
                        headerOffset: $('#header').height()
                    },
                    responsive: false,
                    paging: false,
                    responsive: false,
                    ajax:"{{ url('kasir/get_data')}}?nomor_stok={{$id}}",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
						{ data: 'kode' },
						{ data: 'nama_barang' },
						{ data: 'qty'  ,className: "text-right" },
						{ data: 'satuan' },
						{ data: 'uang_harga_jual' ,className: "text-right"  },
						{ data: 'uang_harga_beli' ,className: "text-right"  },
						{ data: 'uang_discon_jual' ,className: "text-right"  },
						{ data: 'uang_total_jual' ,className: "text-right"  },
						{ data: 'action' },
						
					],
					language: {
						paginate: {
							// remove previous & next text from pagination
							previous: '<< previous',
							next: 'Next>>'
						}
					}
                });
            }
        };

        var TableManageFixedHeader = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleDataTableFixedHeader();
                }
            };
        }();

        $("#default-select3").select2();
        $("#tanggaldate").datepicker({
            format:'yyyy-mm-dd'
        });
        @if($id==0)
            $('#modal-form').modal({backdrop: 'static', keyboard: false})  
        @endif

        $(document).ready(function() {
			TableManageFixedHeader.init();
            @if($id==0)

            @else
            $('#tampil-form').load("{{url('kasir/modal')}}?id={{$id}}")
            // $.ajax({
            //     type: 'GET',
            //     url: "{{url('kasir/modal')}}",
            //     data: "id={{$id}}",
            //     success: function(msg){
            //         $('#tampil-form').html(msg)
            //     }
            // });
					
            @endif
		});

        function edit_data(id){
            $('#tampil-form').load("{{url('kasir/modal')}}?id={{$id}}&ide="+id+"&act=edit")
        }
        function data_baru(){
            location.assign("{{url('kasir/create')}}?id=0")
        }

        function terima_data(){
            $('#modal-terima .modal-title').text('Konfirmasi ');
            $('#modal-terima').modal('show');
            $('#tampil-form-terima').load("{{url('kasir/modal_terima')}}?id={{$id}}")
        }
        function cetak_data(){
            $('#modal-cetak .modal-title').text('Konfirmasi ');
            $('#modal-cetak').modal('show');
            $('#tampil-form-cetak').load("{{url('kasir/print')}}?id={{$id}}")
        }
       
        function printDiv(divId,title) {

            let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

            mywindow.document.write(`<html><head><title>${title}</title>`);
            mywindow.document.write('</head><body >');
            mywindow.document.write(document.getElementById(divId).innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }

        function delete_data(id){
           
			swal({
				title: "Yakin menghapus data ini ?",
				text: "data akan hilang dari daftar ini",
				type: "warning",
				icon: "error",
				showCancelButton: true,
				align:"center",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}).then((willDelete) => {
				if (willDelete) {
						$.ajax({
							type: 'GET',
							url: "{{url('kasir/delete_data_stok')}}",
							data: "id="+id,
							success: function(msg){
								document.getElementById("loadnya").style.width = "0px";
                                
                                $('#tampil-form').load("{{url('kasir/modal')}}?id={{$id}}&ide=0&act=new")
                                var table=$('#data-table-fixed-header').DataTable();
                                    table.ajax.url("{{ url('kasir/get_data')}}?nomor_stok={{$id}}").load();    
							}
						});
					
					
				} else {
					
				}
			});
			
		}

        
        

        

        function simpan_order(){
            
            var form=document.getElementById('mydataorder');
            
                
                $.ajax({
                    type: 'POST',
                    url: "{{ url('kasir') }}",
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
                            location.assign("{{url('kasir/create')}}?id="+bat[2])   
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

        function simpan_selesai(){
            
            var form=document.getElementById('mydataselesai');
            
                
                $.ajax({
                    type: 'POST',
                    url: "{{ url('kasir/store_selesai') }}",
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
