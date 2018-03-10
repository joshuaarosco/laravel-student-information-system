@extends('backoffice._layouts.main')

@section('content')
	<div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">{{$page_title}} Form</h2>
            <ol class="breadcrumb page-head-nav">
                <li>
                    <a href="{{route('backoffice.dashboard')}}">Home</a>
                </li>
                <li>
                    <a href="{{route('backoffice.'.$route_file.'.index')}}">All Records</a>
                </li>
                <li class="active">Create</li>
            </ol>
        </div>
        <div class="main-content container-fluid">
            <!--Basic forms-->
            <div class="row">
                <div class="col-sm-8">
                    @include('backoffice._components.notification')
                    <div class="panel panel-default panel-border-color panel-border-color-primary">
                        <div class="panel-heading panel-heading-divider">
                            {{$page_title}} Form<span class="panel-subtitle">{{$page_description}}</span>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">

                                <div class="form-group {{$errors->first('section_id') ? 'has-error' : NULL}} xs-pt-10">
                                    <label class="control-label">Section</label> 
                                    {!!Form::select('section_id',$sections,old('section_id',$class->section_id),['class' => "form-control input-sm"])!!}
                                    @if($errors->first('section_id'))
                                    <span class="help-block">{!!$errors->first('section_id')!!}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('student_ids') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Students</label> <br>
                                            {!!Form::select('student_ids[]',$students,old('student_ids',explode(', ',$class->student_ids)),['class'=>"", 'multiple' => "multiple" , 'id' => "searchable"])!!}
                                            @if($errors->first('student_ids'))
                                            <span class="help-block">{!!$errors->first('student_ids')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('subject_ids') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Subjects</label> <br>
                                            {!!Form::select('subject_ids[]',$subjects,old('subject_ids',explode(', ',$class->subject_ids)),['class'=>"", 'multiple' => "multiple" , 'id' => "my-select"])!!}
                                            @if($errors->first('subject_ids'))
                                            <span class="help-block">{!!$errors->first('subject_ids')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row xs-pt-15">
                                    <div class="col-xs-12">
                                        <p class="text-right">
                                            <button class="btn btn-space btn-primary" type="submit">Submit</button> 
                                            <a href="{{route('backoffice.'.$route_file.'.index')}}" class="btn btn-space btn-default">Cancel</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/material-design-icons/css/material-design-iconic-font.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/daterangepicker/css/daterangepicker.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/select2/css/select2.min.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/bootstrap-slider/css/bootstrap-slider.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/bootstrap-multiselect/css/bootstrap-multiselect.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('backoffice/assets/lib/multiselect/css/multi-select.css')}}"/>
<link rel="stylesheet" href="{{asset('backoffice/assets/css/style.css')}}" type="text/css"/>
@stop

@section('page-scripts')
<script src="{{asset('backoffice/assets/lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/js/main.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/jquery.nestable/jquery.nestable.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/moment.js/min/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/daterangepicker/js/daterangepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/bootstrap-slider/js/bootstrap-slider.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/bootstrap-multiselect/js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/multiselect/js/jquery.multi-select.js')}}" type="text/javascript"></script>
<script src="{{asset('backoffice/assets/lib/quicksearch/jquery.quicksearch.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.formMultiselect();
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
        //initialize the javascript
        App.init();
        App.formElements();
    });
</script>
<link href="{{ asset('backoffice/summernote/summernote.css')}}" rel="stylesheet"> 
<script src="{{ asset('backoffice/summernote/summernote.min.js')}}"></script> 
{{-- <script src="{{asset('frontend/summernote/summernote-cleaner.js')}}"></script> --}}
<script type="text/javascript">     
    $(function(){           
        $(".summernote").summernote({ 
            height : 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table',['table']],
                ['insert',['link','picture','video']],
                ['view',[/*'fullscreen',*/'codeview','help','undo','redo']]
            ],
            fontNames:["Arial","Arial Black","Comic Sans MS","Courier New","Helvetica Neue","Helvetica","Impact","Lucida Grande","Tahoma","Times New Roman","Verdana","Roboto"],

            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            },
            cleaner:{
                 notTime: 2400, // Time to display Notifications.
                 action: 'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                 newline: '<br>', // Summernote's default is to use '<p><br></p>'
                 notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
                 icon: '<i class="note-icon">Reset</i>',
                 keepHtml: false, // Remove all Html formats
                 keepClasses: false, // Remove Classes
                 badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
                 badAttributes: ['style', 'start'] // Remove attributes from remaining tags
            },
            dialogsFade: true,
            dialogsInBody: true,
            placeholder: 'Description'
        }); 

        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            data.append("api_token","{{env('APP_KEY')}}");
            $.ajax({
                data: data,
                type: "POST",
                url: "{{route('api.summernote',['json'])}}",
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                 if(data.status == true){
                  $('.summernote').summernote('insertImage', data.image);
                 }
                }
            });
        }       
    }); 
</script>
@stop
