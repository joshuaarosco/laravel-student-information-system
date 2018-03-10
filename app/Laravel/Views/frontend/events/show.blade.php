@extends('frontend._layout.main')

@section('content')
        <div id="page-content" class="page-wrapper">
            <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
                <div class="container">
                    <div class="container">
                                <div class="row">
                                    <ul class="breadcrumb">
                                        <li class="completed"><a href="{{route('frontend.index')}}">Home</a></li>
                                        <li class="active"><a href="{{route('frontend.events.index')}}">Event Calendar</a></li>
                                        <li><a class="active-bread-crumb">{{$event->title}}</a></li>
                                    </ul>
                                </div>
                            </div>
                    <div class="row">
                        <!-- Start left side -->
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 columns">
                            <div class="row mb-40">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h2 class="h6 header-color inline-block uppercase">Event Title Here</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Start single post image formate-->
                                <div class="col-md-12">
                                    <article class="zm-post-lay-single">
                                        <div class="zm-post-thumb">
                                            <a href="#"><img src="{{asset($event->directory.'/'.$event->filename)}}" alt="img" class="pb-30"></a>
                                        </div>
                                        <div class="zm-post-dis">
                                            <div class="zm-post-header">
                                                <h2 class="zm-post-title h2">{{$event->title}} ({{$event->sub_title}})</h2>
                                            </div>
                                            <div class="zm-post-content pb-20">
                                                <p>{!!$event->excerpt!!}</p>
                                            </div>
                                        </div>
                                    </article>

                                    <div class="row mb-40">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pt-30">
                                            <div class="section-title">
                                            <h2 class="h6 header-color inline-block uppercase">Event Details</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="zm-post-content pt-10">
                                        <p>{!!$event->details!!}</p>
                                    </div>

                                    <!-- Maps here -->
                                    <div class="row mb-40">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pt-30">
                                            <div class="section-title">
                                            <h2 class="h6 header-color inline-block uppercase">Event Address (Map)</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="zm-post-content ">
                                        <iframe
                                        width="100%" height="450" frameborder="0" style="border:0" allowfullscreen
                                        src="https://www.google.com/maps/embed/v1/place?q={{rawurlencode($event->address)}}&key=AIzaSyBdEM1RnU1GtMQ1ZovQZq8R1jt7uGSzP1s" allowfullscreen="false">
                                        </iframe>
                                        {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15446.986693775545!2d121.021158!3d14.556474!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb84e9475c10d1b53!2sCalata+Corporation+-+Manila+Office!5e0!3m2!1sen!2sph!4v1505108715481" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> --}}
                                    </div>

                                </div>
                                <!--Start Similar post -->
                                @include('frontend._components.press-releases')
                                <!-- End similar post -->
                            </div>
                        </div>
                        <!-- End left side -->
                        <!-- Start Right sidebar -->
                        @include('frontend._components.side-bar')
                        <!-- End Right sidebar -->
                    </div>
                </div>
            </div>
        </div>
@stop