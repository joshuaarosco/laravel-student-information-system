@extends('backoffice._layouts.main')

@section('content')
<div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title"><strong>{{$subject->subject_title}}</strong> - {{$section->section_name}}</h2>
            <ol class="breadcrumb page-head-nav">
                <li>
                    <a href="{{route('backoffice.dashboard')}}">Home</a>
                </li>
                <li class="active">All Records</li>
            </ol>
        </div>
        <div class="main-content container-fluid">
            <div class="row">
                <form action="{{route('backoffice.class_record.update_grades',['id' => $section->id, 'subject_id' => $subject->id])}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="col-sm-12">
                        @include('backoffice._components.notification')
                        <div class="panel panel-default panel-table">
                            <div class="panel-heading">
                                {{$section->section_name}} Grades in {{$subject->subject_title}}
                                <div class="tools dropdown">
                                    {{-- <a href="{{route('backoffice.'.$route_file.'.create')}}"><span class="icon mdi mdi-plus"></span></a> --}}
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-hover table-fw-widget table-reponsive" id="table1">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%;">#</th>
                                            <th style="width: 20%;">LRN</th>
                                            <th style="width: 30%;">Student</th>
                                            <th style="width: 10%;">First Grading</th>
                                            <th style="width: 10%;">Second Grading</th>
                                            <th style="width: 10%;">Third Grading</th>
                                            <th style="width: 10%;">Fourth Grading</th>
                                            <th style="width: 10%;" class="text-center">Average</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $index => $student)
                                        <tr class="odd gradeX">
                                            <td>{{$index+1}}</td>
                                            <td><strong>{{$student->lrn}}</strong></td>
                                            <td>{{"{$student->lname}, {$student->fname} {$student->mname}"}}</td>
                                            <td><input type="number" min="0" max="100" step="any" value="{{round($subject->encode_grade($section->id,$subject->id,$student->id)->first_grading,2)}}" class="form-control input-sm" name="1st_grading[{{$student->id}}]"></td>
                                            <td><input type="number" min="0" max="100" step="any" value="{{round($subject->encode_grade($section->id,$subject->id,$student->id)->second_grading,2)}}" class="form-control input-sm" name="2nd_grading[{{$student->id}}]"></td>
                                            <td><input type="number" min="0" max="100" step="any" value="{{round($subject->encode_grade($section->id,$subject->id,$student->id)->third_grading,2)}}" class="form-control input-sm" name="3rd_grading[{{$student->id}}]"></td>
                                            <td><input type="number" min="0" max="100" step="any" value="{{round($subject->encode_grade($section->id,$subject->id,$student->id)->fourth_grading,2)}}" class="form-control input-sm" name="4th_grading[{{$student->id}}]"></td>
                                            <td class="text-center">{{round($subject->encode_grade($section->id,$subject->id,$student->id)->average,2)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-success btn-lg">Save Grades</button>
                    </div>
                </form>
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
