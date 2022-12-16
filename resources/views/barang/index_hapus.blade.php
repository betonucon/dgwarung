@extends('layouts.web')

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
                
                <div class="panel-body">       
                    <div class="table-responsive ">
                        <form  id="mydatahapus" method="post" action="{{ url('barang/delete_data_all') }}" enctype="multipart/form-data" >
                            
                            @csrf 
                            <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" width="5%">No</th>
                                        <th class="text-nowrap" width="5%"><input id="checkAll" type="checkbox"></th>
                                        <th class="text-nowrap" width="10%">Kode</th>
                                        <th class="text-nowrap"  width="25%">Nama Barang</th>
                                        <th class="text-nowrap" >Keterangan</th>
                                        <th class="text-nowrap"  width="7%">Satuan</th>
                                        <th class="text-nowrap"  width="10%" style="text-align:left !important">H.Jual</th>
                                        <th class="text-nowrap"  width="10%" style="text-align:left !important">H.Beli</th>
                                        <th class="text-nowrap"  width="6%"">Discon</th>
                                        <th class="text-nowrap" width="8%">Act</th>
                                    </tr>
                                </thead>
                                
                            </table>
                        </form>
                    </div>
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>
    <!-- end row -->
</div>
<div class="modal fade" id="modal-kalkulator" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Perhitungan Rupiah Ke %</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
               
                <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="text" id="harga_jual_nya" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Potongan</label>
                    <input type="text" id="potongannya" onkeyup="tentukan_persen(this.value)" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Hasil</label>
                    <input type="text" id="hasilnya" class="form-control" />
                </div>
                
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-danger" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-primary"  >Gunakan</a>
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
                    lengthMenu: [20,50,100],
                    fixedHeader: {
                        header: true,
                        headerOffset: $('#header').height()
                    },
                    responsive: false,
                    ajax:"{{ url('barang/get_data_hapus')}}",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
						{ data: 'checkbox' },
						{ data: 'kode' },
						{ data: 'nama_barangnya' },
						{ data: 'keterangan' },
						{ data: 'satuan' },
						{ data: 'uang_harga_jual',className: "text-right"  },
						{ data: 'uang_harga_beli',className: "text-right"  },
						{ data: 'diskonnya' },
						{ data: 'action' },
						
					],
                    select: {
                        style: 'os',
                        selector: 'td:first-child'
                    },
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

        $("#checkAll").click(function(){
            if (this.checked) {
                $('.checkbox').not(this).prop('checked', this.checked);
            }
        });
        function buat_baru(){
            $('#tampil-form').load("{{url('barang/modal')}}?id=0")
        }
        function tampil_kalkulator(){
            var jual=$('#harga_jual_int').val();
            $('#harga_jual_nya').val(jual);
            $('#modal-kalkulator').modal("show");
        }
        function tentukan_persen(nilai){
            var jual=$('#harga_jual_nya').val();
            var hasil=Math.ceil((nilai/jual)*100);
                $('#hasilnya').val(hasil);
        }
        function edit_data(id){
            $('#tampil-form').load("{{url('barang/modal')}}?id="+id)
        }
       

        function restore_data(id){
           
			swal({
				title: "Yakin merestore data ini ?",
				text: "data akan dikembalikan kedata barang",
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
							url: "{{url('barang/restore_data')}}",
							data: "id="+id,
							success: function(msg){
								swal("Success! berhasil terhapus!", {
									icon: "success",
								});
								var table=$('#data-table-fixed-header').DataTable();
								table.ajax.url("{{ url('barang/get_data_hapus')}}").load();
							}
						});
					
					
				} else {
					
				}
			});
			
		}
        function delete_data_all(){
           
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
                    var form=document.getElementById('mydatahapus');
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('barang/delete_data_all') }}",
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
                                            title: "Success! berhasil dihapus!",
                                            icon: "success",
                                    });
                                    var table=$('#data-table-fixed-header').DataTable();
								    table.ajax.url("{{ url('barang/get_data')}}").load();    
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
					
					
				} else {
					
				}
			});
			
		}

        
        function simpan_data(){
            
            var form=document.getElementById('mydata');
            
                
                $.ajax({
                    type: 'POST',
                    url: "{{ url('barang') }}",
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
                            $('#tampil-form').load("{{url('barang/modal')}}?id=0")
                            var table=$('#data-table-fixed-header').DataTable();
			                    table.ajax.url("{{ url('barang/get_data')}}").load();    
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
