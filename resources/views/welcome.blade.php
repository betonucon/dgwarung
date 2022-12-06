@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Profil</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Form Plugins <small>header small text goes here...</small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-xl-8">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Bootstrap Date Time Picker</h4>
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
                    <form class="form-horizontal form-bordered">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Default Date Time</label>
                            <div class="col-lg-8">
                                <div class="input-group date" id="datetimepicker1">
                                    <input type="text" class="form-control" />
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Custom Format</label>
                            <div class="col-lg-8">
                                <div class="input-group date" id="datetimepicker2">
                                    <input type="text" class="form-control" />
                                    <span class="input-group-addon">
                                    <i class="fa fa-clock"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Linked Pickers</label>
                            <div class="col-lg-8">
                                <div class="row row-space-10">
                                    <div class="col-xs-6 mb-2 mb-sm-0">
                                        <input type="text" class="form-control"  id="datetimepicker3" placeholder="Min Date" />
                                    </div>
                                    <div class="col-xs-6">
                                        <input type="text" class="form-control" id="datetimepicker4" placeholder="Max Date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>
    <!-- end row -->
</div>
@endsection
