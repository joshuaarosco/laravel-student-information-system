@extends('frontend._layout.main')

@section('content')        
<section id="page-content" class="page-wrapper">
    <!-- Start contact message area -->
    <div class="zm-section bg-white pt-60">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <div class="section-title-2 mb-40  text-center">
                        <h3 class="inline-block uppercase">Send Us A MEssage</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-12">
                    @if(Session::get('notification-status') == "success")
                    <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
                        <div class="icon"><span class="mdi mdi-check"></span></div>
                        <div class="message">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>{{Session::get('notification-title',"Success")}}!</strong> {!! Session::get('notification-msg') !!}.
                        </div>
                    </div>
                    @elseif(Session::get('notification-status') == "error")
                    <div role="alert" class="alert alert-danger alert-icon alert-icon-border alert-dismissible">
                        <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
                        <div class="message">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>{{Session::get('notification-title',"Failed")}}!</strong> {!! Session::get('notification-msg') !!}.
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="message-box">
                <form action="#" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" placeholder="Full Name*" title="{{$errors->first('name')? $errors->first('name') : NULL}}" style="border: 1px solid {{$errors->first('name')? 'red' : '#e6e6e6'}}"  data-toggle="tooltip">
                            <input type="email" name="email" placeholder="Email Address*" title="{{$errors->first('email')? $errors->first('email') : NULL}}" style="border: 1px solid {{$errors->first('email')? 'red' : '#e6e6e6'}}" data-toggle="tooltip">
                            <input type="text" name="contact" placeholder="Phone Number" title="{{$errors->first('contact')? $errors->first('contact') : NULL}}" style="border: 1px solid {{$errors->first('contact')? 'red' : '#e6e6e6'}}" data-toggle="tooltip">
                            <input type="text" name="subject" placeholder="Subject" title="{{$errors->first('subject')? $errors->first('subject') : NULL}}" style="border: 1px solid {{$errors->first('subject')? 'red' : '#e6e6e6'}}" data-toggle="tooltip">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea name="message" placeholder="Type your message..." title="{{$errors->first('message')? $errors->first('message') : NULL}}" style="border: 1px solid {{$errors->first('message')? 'red' : '#e6e6e6'}}" data-toggle="tooltip"></textarea>
                            <button class="submit-button" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End contact message area -->
    <div class="zm-section bg-white ptb-65">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <div class="section-title-2 mb-40  text-center">
                        <h3 class="inline-block uppercase">Contact Us</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4  col-sm-4">
                    <div class="single-address text-center">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <h4>Address</h4>
                        <p>70 A, Jl. Sisingamangaraja </p>
                        <p>Jakarta 12110, Indonesia</p>
                    </div>
                </div>
                <div class="col-md-4  col-sm-4 xs-mt-30">
                    <div class="single-address text-center">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <h4 class="uppercase">Email Address</h4>
                        <p>suport@zmagazine.com</p>
                        <p>contactus@zmagazine.com</p>
                    </div>
                </div>
                <div class="col-md-4  col-sm-4 xs-mt-30">
                    <div class="single-address text-center">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <h4 class="uppercase">Phone Number</h4>
                        <p>+12 345 678 9008</p>
                        <p>+12 987 654 7566</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Google Map area -->
    <div class="zm-section">
        <div class="container-fluid">
            <div class="row">
                <div class="google-map">
                    <div id="googleMap" style="width:100%;height:600px;"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Google Map area -->
</section>
@stop

@section('page-scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuU_0_uLMnFM-2oWod_fzC0atPZj7dHlU"></script>
<script>
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // Basic options for a simple Google Map
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 12,

                scrollwheel: false,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(-6.2381534,106.7969463), // New York
            };

            // Get the HTML DOM element that will contain your map 
            var mapElement = document.getElementById('googleMap');

            // Create the Google Map using our element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            // Let's also add a marker while we're at it
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(-6.2381534,106.7969463),
                map: map,
                title: 'Corpex!',
                icon: 'images/icons/marger.png',
                animation:google.maps.Animation.BOUNCE

            });
            var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<div id="bodyContent">'+
            '<h4>ASEAN BAC</h4>'+       
            '<p>Address</p>'+       
            '</div>'+
            '</div>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            infowindow.open(map, marker);
        }
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
@stop
