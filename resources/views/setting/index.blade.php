@extends('layouts.web')

@push('style')
<link href="{{url_plug()}}/assets/plugins/x-editable-bs4/dist/bootstrap4-editable/css/bootstrap-editable.css" rel="stylesheet" />
@endpush
@section('content')
<div id="content" class="content">
    
    <div class="row">
            
                <div class="col-xl-12 ui-sortable">
					<!-- begin panel -->
					<div class="panel panel-inverse">
						<div class="panel-heading ui-sortable-handle">
							<h4 class="panel-title">Form Editable</h4>
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<!-- begin table-responsive -->
						<div class="table-responsive">
							<table id="user" class="table table-condensed table-bordered">
								<thead>
									<tr>
										<th width="20%">Setting</th>
										<th>Value</th>
										<th>Deskripsi</th>
									</tr>
								</thead>
								<tbody>
                                    <tr>
										<td class="bg-light">{{first_setting(1)['name']}}</td>
										<td><a href="javascript:;" onclick="tambah(1,`Setting Provit`)" data-type="text" data-pk="1" data-title="Enter Username" class="editable editable-click">{{status_provit(setting_provit())}} @if(setting_provit()==1) {{setting_provit_value()}}% @endif</a></td>
										<td><span class="text-black-lighter">{{first_setting(1)['deskripsi']}}</span></td>
									</tr>
                                    <tr>
										<td class="bg-light">{{first_setting(2)['name']}}</td>
										<td><a href="javascript:;" onclick="tambah(2,`Setting Penggunaan Stok`)" data-type="text" data-pk="2" data-title="Enter Username" class="editable editable-click">{{status_aktive_stok(setting_aktive_stok())}} @if(setting_aktive_stok()==2) {{setting_aktive_stok_value()}}% @endif</a></td>
										<td><span class="text-black-lighter">{{first_setting(2)['deskripsi']}}</span></td>
									</tr>
                                    <tr>
										<td class="bg-light">{{first_setting(3)['name']}}</td>
										<td><a href="javascript:;" onclick="tambah(3,`Setting Ukuran Font Printer`)" data-type="text" data-pk="3" data-title="Enter Username" class="editable editable-click">{{setting_font_print()}}PX</a></td>
										<td><span class="text-black-lighter">{{first_setting(3)['deskripsi']}}</span></td>
									</tr>
                                    <tr>
										<td class="bg-light">{{first_setting(4)['name']}}</td>
										<td><a href="javascript:;" onclick="tambah(4,`Aktivasi Transaksi`)" data-type="text" data-pk="4" data-title="Enter Username" class="editable editable-click">@if(aktive_transaksi()==1) Aktif @else Non Aktif @endif</a></td>
										<td><span class="text-black-lighter">{{first_setting(4)['deskripsi']}}</span></td>
									</tr>
									
								</tbody>
							</table>
						</div>
						<!-- end table-responsive -->
					</div>
					<!-- end panel -->
				</div>
        
    </div>
    <!-- end row -->
</div>
<div class="modal fade" id="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <!-- <div class="alert alert-danger m-b-0" id="notifikasiimport">
                    <div id="notifikasi-import"></div>
                    
                </div> -->
                <form class="form-horizontal form-bordered" style="margin-bottom: 1%; padding: 1% 0 1% 0;" id="mydata" method="post" action="{{ url('warga') }}" enctype="multipart/form-data" >
                    @csrf 
                    <div id="tampil-form"></div>
                 </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" onclick="simpan_data()" >Proses</a>
            </div>
        </div>
    </div>
</div>   
@endsection

@push('ajax')
<script src="{{url_plug()}}/assets/plugins/x-editable-bs4/dist/bootstrap4-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript">
        

        function tambah(id,name){
            $('#modal-form .modal-title').text(name);
            $('#modal-form').modal('show');
            $('#tampil-form').load("{{url('setting/modal')}}?id="+id);
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
							url: "{{url('pengumuman/delete_data')}}",
							data: "id="+id,
							success: function(msg){
								swal("Success! berhasil terhapus!", {
									icon: "success",
								});
								var table=$('#data-table-fixed-header').DataTable();
								table.ajax.url("{{ url('pengumuman/get_data')}}").load();
							}
						});
					
					
				} else {
					
				}
			});
			
		}

        function simpan_data(){
            
            var form=document.getElementById('mydata');
            
                
                $.ajax({
                    type: 'POST',
                    url: "{{ url('setting') }}",
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

        
    </script>
@endpush
