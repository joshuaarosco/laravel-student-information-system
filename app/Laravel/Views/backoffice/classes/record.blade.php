@extends('backoffice._layouts.main')

@section('content')
<div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">Class Record</h2>
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
                            Class Record
                            <div class="tools dropdown">
                                <a href="{{route('backoffice.'.$route_file.'.create')}}"><span class="icon mdi mdi-plus"></span></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-hover table-fw-widget table-reponsive" id="table1">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;">#</th>
                                        <th style="width: 10%;">LRN</th>
                                        <th style="width: 20%;">Student</th>
                                        @foreach($subjects as $index => $subject)
                                        <th style="width: 10%;" class="text-center"><a href="#" data-toggle="modal" style="color: #404040;" data-target="#edit-grades-{{$subject->subject_title}}">{{$subject->subject_title}} Average</a></th>
                                        @endforeach
                                        <th style="width: 10%;" title="actions" class="text-center">Total Average</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($students as $index => $student)
                                    <tr class="odd gradeX">
                                        <td>{{$index+1}}</td>
                                        <td><strong>{{$student->lrn}}</strong></td>
                                        <td>{{"{$student->lname}, {$student->fname} {$student->mname}"}}</td>
                                        <?php $grade = [];?>
                                        @foreach($subjects as $data => $subject)
                                        <td class="text-center">
                                            <?php array_push($grade,$subject->class_record($class->id,$subject->id,$student->id)->average);?>
                                            {{-- <a href="#" data-toggle="modal" data-target="#edit-grades-{{$subject->id}}"> --}}{{round($subject->class_record($class->id,$subject->id,$student->id)->average,2)}}{{-- </a> --}}
                                        </td>
                                        @endforeach
                                        <td class="text-center"><strong>{{round(array_sum($grade)/$subjects->count(),2)}}</strong></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
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

@foreach($subjects as $data => $subject)
{{-- <div id="edit-grades-{{$subject->id}}" tabindex="-2" role="dialog" class="modal fade">
    <div class="modal-dialog" style="width: 95%!important;">
        <div class="modal-content" style="max-width: 100%!important;">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
                <h4 class="modal-title"><strong>{{Str::upper($subject->subject_title)}}</strong></h4>
            </div>
            <form action="{{route('backoffice.classes.update_grades',['id' => $class->id, 'subject_id' => $subject->id])}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-condensed table-hover table-bordered table-striped">
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
                                        <td><input type="number" min="0" max="100" step="any" value="{{round($subject->class_record($class->id,$subject->id,$student->id)->first_grading,2)}}" class="form-control input-sm" name="1st_grading[{{$student->id}}]"></td>
                                        <td><input type="number" min="0" max="100" step="any" value="{{round($subject->class_record($class->id,$subject->id,$student->id)->second_grading,2)}}" class="form-control input-sm" name="2nd_grading[{{$student->id}}]"></td>
                                        <td><input type="number" min="0" max="100" step="any" value="{{round($subject->class_record($class->id,$subject->id,$student->id)->third_grading,2)}}" class="form-control input-sm" name="3rd_grading[{{$student->id}}]"></td>
                                        <td><input type="number" min="0" max="100" step="any" value="{{round($subject->class_record($class->id,$subject->id,$student->id)->fourth_grading,2)}}" class="form-control input-sm" name="4th_grading[{{$student->id}}]"></td>
                                        <td class="text-center">{{round($subject->class_record($class->id,$subject->id,$student->id)->average,2)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}
@endforeach
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
