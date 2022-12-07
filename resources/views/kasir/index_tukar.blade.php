@extends('layouts.web')
@push('style')
    <style>
        .table td {
			padding: 5px 8px  !important;
			vertical-align: top;
			border-top: 1px solid #e4e7ea;
			font-size:11px;
		}
		.table th {
			padding: 8px !important;
			vertical-align: top;
			border-top: 1px solid #e4e7ea;
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
                    
                </div>
                <div class="panel-body">       
                    <div class="table-responsive ">
                        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-nowrap" width="5%">No</th>
                                    <th class="text-nowrap" width="10%">Nomor Stok</th>
                                    <th class="text-nowrap" width="10%">Kode</th>
                                    <th class="text-nowrap">Nama Barang</th>
                                    <th class="text-nowrap"  width="25%">Supplier</th>
                                    <th class="text-nowrap"  width="7%">Satuan</th>
                                    <th class="text-nowrap"  width="7%">Qty</th>
                                    <th class="text-nowrap"  width="5%"></th>
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
<div class="modal fade" id="modal-import" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alert Header</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notifikasiimport">
                    <div id="notifikasi-import"></div>
                    
                </div>
                <form class="form-horizontal form-bordered" id="mydataimport" method="post" action="{{ url('pengumuman/import') }}" enctype="multipart/form-data" >
                    @csrf 
                    <!-- <input type="submit"> -->
                    <div class="form-group">
                        <label>Upload File Excel</label>
                        <input type="file" name="file" class="form-control" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="import-data" >Proses</a>
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
                    ajax:"{{ url('stokorder/get_data_tukar')}}",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
						{ data: 'nomor_stok' },
						{ data: 'kode' },
						{ data: 'nama_barang' },
						{ data: 'supplier' },
						{ data: 'satuan' },
						{ data: 'qty' },
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

        $(document).ready(function() {
			TableManageFixedHeader.init();
            $('#tampil-form').load("{{url('barang/modal')}}?id=0")
		});

        function edit_data(id){
            $('#tampil-form').load("{{url('barang/modal')}}?id="+id)
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
							url: "{{url('stokorder/delete_tukar')}}",
							data: "id="+id,
							success: function(msg){
								swal("Success! berhasil terhapus!", {
									icon: "success",
								});
								var table=$('#data-table-fixed-header').DataTable();
								table.ajax.url("{{ url('stokorder/get_data_tukar')}}").load();
							}
						});
					
					
				} else {
					
				}
			});
			
		}

        function proses_tukar(id){
           
			swal({
				title: "Yakin proses data ini ?",
				text: "",
				type: "warning",
				icon: "info",
				showCancelButton: true,
				align:"center",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}).then((willDelete) => {
				if (willDelete) {
						$.ajax({
							type: 'GET',
							url: "{{url('stokorder/proses_tukar')}}",
							data: "id="+id,
							success: function(msg){
								swal("Success! berhasil diproses!", {
									icon: "success",
								});
								var table=$('#data-table-fixed-header').DataTable();
								table.ajax.url("{{ url('stokorder/get_data_tukar')}}").load();
							}
						});
					
					
				} else {
					
				}
			});
			
		}

       
    </script>
@endpush
