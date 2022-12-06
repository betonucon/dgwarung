@extends('layouts.web')

@section('content')
<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Dashboard <small>header small text goes here...</small></h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-3 -->
                
				<div class="col-xl-4 col-md-6">
					<div class="widget widget-stats bg-blue">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>ssss</h4>
							<p>sss</p>	
						</div>
						<div class="stats-link">
							<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				
				
			</div>
			<!-- end row -->
			<!-- begin row -->
			<div class="row">
				<!-- begin col-8 -->
				<div class="col-xl-7">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="index-1">
						<div class="panel-heading">
							<h4 class="panel-title">Grafik Pelayanan</h4>
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="panel-body pr-1">
							<div id="interactive-chart" class="height-sm"></div>
						</div>
					</div>
					
					
					
                    
					
				</div>
				<!-- end col-8 -->
				<!-- begin col-4 -->
				<div class="col-xl-5">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="index-6">
						<div class="panel-heading">
							<h4 class="panel-title">Pelayanan</h4>
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-valign-middle table-panel mb-0">
								<thead>
									<tr>	
										<th>Pelayanan</th>
										<th width="10%">Konfirmasi</th>
										<th width="10%">Pemrosesan</th>
										<th width="10%">Selesai</th>
									</tr>
								</thead>
								<tbody>
                                    
								</tbody>
							</table>
						</div>
					</div>
					
				</div>
				<!-- end col-4 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
@endsection
