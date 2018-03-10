<html>
	<body style="font-family: Calibri,sans-serif;">
		<h2>THANK YOU VERY MUCH {{Str::upper($name)}}!</h2>
		<p style="color: grey;"><strong>YOU HAVE SUCCESSFULLY REGISTERED FOR THE ABAC NEWSLETTER.</strong><br><span style="color: black;">
		Thank you very much for your interest and have lots of ideas finding out what the fascinating world of business has to offer.</span></p>
		<br>
		<small><a href="{{route('frontend.unsubscribe',$email)}}" target="_blank">Click here</a> if you want to unsubscribe.</small>
	</body>
</html>