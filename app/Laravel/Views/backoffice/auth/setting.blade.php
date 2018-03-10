@extends('backoffice._layouts.main')

@section('content')
	<div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">{{$page_title}} Form</h2>
            {{-- <ol class="breadcrumb page-head-nav">
                <li>
                    <a href="{{route('backoffice.dashboard')}}">Home</a>
                </li>
            </ol> --}}
        </div>
        <div class="main-content container-fluid">
            <!--Basic forms-->
            <div class="row">
            	<div class="col-md-6">
            		<div class="panel panel-default">
            			<div class="panel-heading panel-heading-divider">Edit Profile<span class="panel-subtitle">Fill in the details below. <code>*</code> required.</span></div>
            			<div class="panel-body">
            				<form method="post">
            					{{ csrf_field() }}
            					<div class="form-group xs-pt-10 {{ $errors->has('fname') ? 'has-error' : '' }}">
            						<label>First Name *</label>
            						<input type="text" name="fname" placeholder="Enter First Name" class="form-control input-sm" value="{{ old('fname', Auth::user()->fname) }}">
            						@if($errors->has('fname'))
            						<span class="help-block">{{ $errors->first('fname') }}</span>
            						@endif
            					</div>
            					<div class="form-group xs-pt-10 {{ $errors->has('lname') ? 'has-error' : '' }}">
            						<label>Last Name *</label>
            						<input type="text" name="lname" placeholder="Enter Last Name" class="form-control input-sm" value="{{ old('lname', Auth::user()->lname) }}">
            						@if($errors->has('lname'))
            						<span class="help-block">{{ $errors->first('lname') }}</span>
            						@endif
            					</div>
            					<div class="form-group xs-pt-10 {{ $errors->has('username') ? 'has-error' : '' }}">
            						<label>Username *</label>
            						<input type="text" name="username" placeholder="Enter Username" class="form-control input-sm" value="{{ old('username', Auth::user()->username) }}">
            						@if($errors->has('username'))
            						<span class="help-block">{{ $errors->first('username') }}</span>
            						@endif
            					</div>
            					<div class="form-group xs-pt-10 {{ $errors->has('email') ? 'has-error' : '' }}">
            						<label>Email *</label>
            						<input type="text" name="email" placeholder="Enter Email" class="form-control input-sm" value="{{ old('email', Auth::user()->email) }}">
            						@if($errors->has('email'))
            						<span class="help-block">{{ $errors->first('email') }}</span>
            						@endif
            					</div>
            					<div class="form-group xs-pt-10 {{ $errors->has('password') ? 'has-error' : '' }}">
            						<label>Password *</label>
            						<input type="password" name="password" placeholder="Enter your Current Password" class="form-control input-sm" value="{{ old('password') }}">
            						@if($errors->has('password'))
            						<span class="help-block">{{ $errors->first('password') }}</span>
            						@endif
            					</div>
            					<div class="row xs-pt-15">
            						<div class="col-xs-12">
            							<p class="text-right">
            								<button type="submit" class="btn btn-space btn-primary">Update</button>
            								<a href="{{ route('backoffice.dashboard') }}" class="btn btn-space btn-default">Cancel</a>
            							</p>
            						</div>
            					</div>
            				</form>
            			</div>
            		</div>
            	</div>
            	<div class="col-md-6">
            		<div class="panel panel-default">
            			<div class="panel-heading panel-heading-divider">Change Password<span class="panel-subtitle">Fill in the details below. <code>*</code> required.</span></div>
            			<div class="panel-body">
            				<form method="post" action="{{ route('backoffice.profile.update_password') }}">
            					{{ csrf_field() }}
            					<div class="form-group xs-pt-10 {{ $errors->has('old_password') ? 'has-error' : '' }}">
            						<label>Old Password *</label>
            						<input type="password" name="old_password" placeholder="Enter Current Password" class="form-control input-sm">
            						@if($errors->has('old_password'))
            						<span class="help-block">{{ $errors->first('old_password') }}</span>
            						@endif
            					</div>
            					<div class="form-group xs-pt-10 {{ $errors->has('new_password') ? 'has-error' : '' }}">
            						<label>New Password *</label>
            						<input type="password" name="new_password" placeholder="Enter New Password" class="form-control input-sm">
            						@if($errors->has('new_password'))
            						<span class="help-block">{{ $errors->first('new_password') }}</span>
            						@endif
            					</div>
            					<div class="form-group xs-pt-10 {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
            						<label>Re-type New Password *</label>
            						<input type="password" name="new_password_confirmation" placeholder="Confirm Password" class="form-control input-sm">
            						@if($errors->has('new_password_confirmation'))
            						<span class="help-block">{{ $errors->first('new_password_confirmation') }}</span>
            						@endif
            					</div>
            					<div class="row xs-pt-15">
            						<div class="col-xs-12">
            							<p class="text-right">
            								<button type="submit" class="btn btn-space btn-primary">Update</button>
            								<a href="{{ route('backoffice.dashboard') }}" class="btn btn-space btn-default">Cancel</a>
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
            placeholder: 'Content'
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
