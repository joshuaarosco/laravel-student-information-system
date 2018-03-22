@extends('backoffice._layouts.main')

@section('content')
<div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">List of {{$page_title}}</h2>
            <ol class="breadcrumb page-head-nav">
                <li>
                    <a href="{{route('backoffice.dashboard')}}">Home</a>
                </li>
                <li class="active">All Records</li>
            </ol>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @include('backoffice._components.notification')
                    <div class="panel panel-default panel-table">
                        <div class="panel-heading">
                            {{$page_title}}
                            <div class="tools dropdown">
                                <a href="{{route('backoffice.'.$route_file.'.create')}}"><span class="icon mdi mdi-plus"></span></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-hover table-fw-widget" id="table1">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th>LRN</th>
                                        <th>Name</th>
                                        <th>Updated At</th>
                                        <th class="actions"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($students as $index => $info)
                                    <tr class="odd gradeX">
                                        <td>{{$index+1}}</td>
                                        <td><strong>{{$info->lrn}}</strong></td>
                                        <td>{{"{$info->lname}, {$info->fname}, {$info->mname}"}}</td>
                                        <td>{{Helper::date_format($info->updated_at,'F d, Y')}}</td>
                                        <td class="actions">
                                        	<div class="btn-group btn-hspace">
                                        		<button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                        		<ul role="menu" class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="{{route('backoffice.'.$route_file.'.view',$info->id)}}" target="_blank">View Info</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{route('backoffice.'.$route_file.'.edit',$info->id)}}">Edit</a>
                                                    </li>
                                        			<li>
                                        				<a href="#" data-toggle="modal" data-url="{{route('backoffice.'.$route_file.'.destroy',[$info->id])}}" data-target="#md-footer-danger" class="action-delete">Delete</a>
                                        			</li>
                                        		</ul>
                                        	</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-modals')
<div id="md-footer-danger" tabindex="-1" role="dialog" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
			</div>
			<div class="modal-body">
				<div class="text-center">
					<div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
					<h3>Danger!</h3>
					<p>This action can not be undone.<br>You are about to delete a record, this action can no longer be undone,<br> are you sure you want to proceed?</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
				<a type="button" class="btn btn-danger" id="btn-confirm-delete">Proceed</a>
			</div>
		</div>
	</div>
</div>
@stop

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/material-design-icons/css/material-design-iconic-font.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/datatables/css/dataTables.bootstrap.min.css')}}"/>
<link rel="stylesheet" href="{{asset('backoffice/assets/css/style.css')}}" type="text/css"/>
@stop

@section('page-scripts')
<script src="{{asset('backoffice/assets/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/js/main.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/datatables/js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/datatables/plugins/buttons/js/buttons.html5.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/datatables/plugins/buttons/js/buttons.flash.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/datatables/plugins/buttons/js/buttons.print.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/datatables/plugins/buttons/js/buttons.colVis.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/datatables/plugins/buttons/js/buttons.bootstrap.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.dataTables();
    });
  $(".action-delete").on("click",function(){
    var btn = $(this);
    $("#btn-confirm-delete").attr({"href" : btn.data('url')});
});
</script>
@stop
