@if(Session::has('notification-status'))
@if(Session::get('notification-status') == "info")
<div id="toast-container" class="toast-container toast-top-right">
	<div class="toast toast-info" aria-live="polite" style="display: block;">
		<div class="toast-title">{{Session::get('notification-title',"Information")}}!</div>
		<div class="toast-message">{!! Session::get('notification-msg') !!}</div>
	</div>
</div>
@endif

@if(Session::get('notification-status') == "success")
<div id="toast-container" class="toast-container toast-top-right">
	<div class="toast toast-success" aria-live="polite" style="display: block;">
		<div class="toast-title">{{Session::get('notification-title',"Success")}}!</div>
		<div class="toast-message">{!! Session::get('notification-msg') !!}</div>
	</div>
</div>
@endif

@if(Session::get('notification-status') == "failed")
<div id="toast-container" class="toast-container toast-top-right">
	<div class="toast toast-error" aria-live="polite" style="display: block;">
		<div class="toast-title">{{Session::get('notification-title',"Failed")}}!</div>
		<div class="toast-message">{!! Session::get('notification-msg') !!}</div>
	</div>
</div>
@endif

@if(Session::get('notification-status') == "warning")
<div id="toast-container" class="toast-container toast-top-right">
	<div class="toast toast-warning" aria-live="polite" style="display: block;">
		<div class="toast-title">{{Session::get('notification-title',"Warning")}}!</div>
		<div class="toast-message">{!! Session::get('notification-msg') !!}</div>
	</div>
</div>
@endif


@endif
