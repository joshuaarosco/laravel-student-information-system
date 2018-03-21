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

                                <div class="form-group {{$errors->first('lrn') ? 'has-error' : NULL}} xs-pt-10">
                                    <label class="control-label">LRN</label> 
                                    <input class="form-control input-sm" value="{{old('lrn',$student->lrn)}}" placeholder="Enter LRN" type="text" name="lrn">
                                    @if($errors->first('lrn'))
                                    <span class="help-block">{!!$errors->first('lrn')!!}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->first('fname') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">First Name</label> 
                                            <input class="form-control input-sm" value="{{old('fname',$student->fname)}}" placeholder="Enter First Name" type="text" name="fname">
                                            @if($errors->first('fname'))
                                            <span class="help-block">{!!$errors->first('fname')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->first('mname') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Middle Name</label> 
                                            <input class="form-control input-sm" value="{{old('mname',$student->mname)}}" placeholder="Enter Middle Names" type="text" name="mname">
                                            @if($errors->first('mname'))
                                            <span class="help-block">{!!$errors->first('mname')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->first('lname') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Last Name</label> 
                                            <input class="form-control input-sm" value="{{old('lname',$student->lname)}}" placeholder="Enter Last Name" type="text" name="lname">
                                            @if($errors->first('lname'))
                                            <span class="help-block">{!!$errors->first('lname')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group {{$errors->first('gender') ? 'has-error' : NULL}} xs-pt-10">
                                    <label class="control-label">Gender</label> 
                                    {!!Form::select('gender',$gender,old('gender',$additional_information->gender),['class'=>"form-control input-sm"])!!}
                                    @if($errors->first('gender'))
                                    <span class="help-block">{!!$errors->first('gender')!!}</span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->first('birthdate') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Birthdate</label> 
                                            <input type="text" name="birthdate" value="{{old('birthdate',$additional_information->birthdate)}}" placeholder="mm/dd/yyyy" class="form-control input-sm">
                                            @if($errors->first('birthdate'))
                                            <span class="help-block">{!!$errors->first('birthdate')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->first('age_of_first_friday_june') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Age as of 1st Friday June</label> 
                                            <input type="text" name="age_of_first_friday_june" value="{{old('age_of_first_friday_june',$additional_information->age_of_first_friday_june)}}" placeholder="Age as of 1st Friday June" class="form-control input-sm">
                                            @if($errors->first('age_of_first_friday_june'))
                                            <span class="help-block">{!!$errors->first('age_of_first_friday_june')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->first('mother_tounge') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Mother Tounge (Grade 1 to 3 Only)</label> 
                                            <input type="text" name="mother_tounge" value="{{old('mother_tounge',$additional_information->mother_tounge)}}" placeholder="Mother Tounge" class="form-control input-sm">
                                            @if($errors->first('mother_tounge'))
                                            <span class="help-block">{!!$errors->first('mother_tounge')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('ip') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">IP (Ethnic Group)</label> 
                                            <input type="text" name="ip" value="{{old('ip',$additional_information->ip)}}" placeholder="IP (Ethnic Group)" class="form-control input-sm">
                                            @if($errors->first('ip'))
                                            <span class="help-block">{!!$errors->first('ip')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('religion') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Religion</label> 
                                            <input type="text" name="religion" value="{{old('religion',$additional_information->religion)}}" placeholder="Religion" class="form-control input-sm">
                                            @if($errors->first('religion'))
                                            <span class="help-block">{!!$errors->first('religion')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h4>Address</h4>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('house_street') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">House #/ Street/ Sitio/ Purok</label> 
                                            <input class="form-control input-sm" value="{{old('house_street',$additional_information->house_street)}}" type="text" placeholder="House #/ Street/ Sitio/ Purok" name="house_street">
                                            @if($errors->first('house_street'))
                                            <span class="help-block">{!!$errors->first('house_street')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('barangay') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Barangay</label> 
                                            <input class="form-control input-sm" value="{{old('barangay',$additional_information->barangay)}}" type="text" placeholder="Barangay" name="barangay">
                                            @if($errors->first('barangay'))
                                            <span class="help-block">{!!$errors->first('barangay')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('municipality') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Municipality</label> 
                                            <input class="form-control input-sm" value="{{old('municipality',$additional_information->municipality)}}" type="text" placeholder="Municipality" name="municipality">
                                            @if($errors->first('municipality'))
                                            <span class="help-block">{!!$errors->first('municipality')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('province') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Province</label> 
                                            <input class="form-control input-sm" value="{{old('province',$additional_information->province)}}" type="text" placeholder="Province" name="province">
                                            @if($errors->first('province'))
                                            <span class="help-block">{!!$errors->first('province')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                
                                <h4>Parents</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('fathers_name') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Father's Name</label> 
                                            <input class="form-control input-sm" value="{{old('fathers_name',$additional_information->fathers_name)}}" placeholder="(Last Name, First Name Middle Name)" type="text" name="fathers_name">
                                            @if($errors->first('fathers_name'))
                                            <span class="help-block">{!!$errors->first('fathers_name')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('mothers_name') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Mother's Name</label> 
                                            <input class="form-control input-sm" value="{{old('mothers_name',$additional_information->mothers_name)}}" placeholder="(Last Name, First Name Middle Name)" type="text" name="mothers_name">
                                            @if($errors->first('mothers_name'))
                                            <span class="help-block">{!!$errors->first('mothers_name')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <h4>Guardian</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('guardian_name') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Guardian Name</label> 
                                            <input class="form-control input-sm" value="{{old('guardian_name',$additional_information->guardian_name)}}" placeholder="(Last Name, First Name Middle Name)" type="text" name="guardian_name">
                                            @if($errors->first('guardian_name'))
                                            <span class="help-block">{!!$errors->first('guardian_name')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->first('relationship') ? 'has-error' : NULL}} xs-pt-10">
                                            <label class="control-label">Relationship</label> 
                                            <input class="form-control input-sm" value="{{old('relationship',$additional_information->relationship)}}" type="text" placeholder="Relationship" name="relationship">
                                            @if($errors->first('relationship'))
                                            <span class="help-block">{!!$errors->first('relationship')!!}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group {{$errors->first('contact_number') ? 'has-error' : NULL}} xs-pt-10">
                                    <label class="control-label">Contact Number of Parents of Guardian</label> 
                                    <input class="form-control input-sm" value="{{old('contact_number',$student->contact_number)}}" type="text" placeholder="Contact Number" name="contact_number">
                                    @if($errors->first('contact_number'))
                                    <span class="help-block">{!!$errors->first('contact_number')!!}</span>
                                    @endif
                                </div>

                                <div class="form-group {{$errors->first('remarks') ? 'has-error' : NULL}} xs-pt-10">
                                    <label class="control-label">Remarks</label> 
                                    <textarea class="form-control input-sm" value="" placeholder="Enter Remarks" type="text" name="remarks">{{old('remarks',$additional_information->remarks)}}</textarea> 
                                    @if($errors->first('remarks'))
                                    <span class="help-block">{!!$errors->first('remarks')!!}</span>
                                    @endif
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
