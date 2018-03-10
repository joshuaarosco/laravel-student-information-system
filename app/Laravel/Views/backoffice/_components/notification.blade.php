@if(Session::has('notification-status'))

@if(Session::get('notification-status') == "info")

<div role="alert" class="alert alert-primary alert-icon alert-icon-border alert-dismissible">
	<div class="icon"><span class="mdi mdi-info-outline"></span></div>
	<div class="message">
		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>{{Session::get('notification-title',"Information")}}!</strong> {!! Session::get('notification-msg') !!}.
	</div>
</div>
@endif

@if(Session::get('notification-status') == "success")

<div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
	<div class="icon"><span class="mdi mdi-check"></span></div>
	<div class="message">
		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>{{Session::get('notification-title',"Success")}}!</strong> {!! Session::get('notification-msg') !!}.
	</div>
</div>
@endif

@if(Session::get('notification-status') == "failed" || Session::get('notification-status') == "error")

<div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible">
	<div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
	<div class="message">
		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>{{Session::get('notification-title',"Failed")}}!</strong> {!! Session::get('notification-msg') !!}.
	</div>
</div>

@endif

@if(Session::get('notification-status') == "warning")

<div role="alert" class="alert alert-warning alert-icon alert-icon-border alert-dismissible">
	<div class="icon"><span class="mdi mdi-alert-triangle"></span></div>
	<div class="message">
		<button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>{{Session::get('notification-title',"Warning")}}!</strong> {!! Session::get('notification-msg') !!}.
	</div>
</div>

@endif



@endif