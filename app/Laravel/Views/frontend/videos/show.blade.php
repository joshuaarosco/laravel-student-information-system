@extends('frontend._layout.main')

@section('content')
        <div id="page-content" class="page-wrapper">
            <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
                <div class="container">
                    <div class="container">
                        <div class="row">
                            <ul class="breadcrumb">
                                <li class="completed"><a href="{{route('frontend.index')}}">Home</a></li>
                                <li class="active"><a href="{{route('frontend.videos.index')}}">Videos</a></li>
                                <li><a class="active-bread-crumb">{{$video->title}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Start left side -->
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 columns">
                            <div class="row mb-40">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h2 class="h6 header-color inline-block uppercase">Video/Article Detail</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Start single post image formate-->
                                <div class="col-md-12">
                                    <article class="zm-post-lay-single">
                                        <div class="zm-post-thumb">
                                            <iframe width="100%" height="500" src="{{$video->embedded_link}}" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                                        </div>
                                        <div class="zm-post-dis">
                                            <div class="zm-post-header">
                                                <h2 class="zm-post-title h2">{{$video->title}}</h2>
                                                <div class="zm-post-meta">
                                                    <ul>
                                                        <li class="s-meta">{{$video->author}}</li>
                                                        <li class="s-meta">{{Helper::date_format($video->created_at,'F d, Y')}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="zm-post-content">
                                                {!!$video->description!!}
                                            </div>
                                        </div>
                                    </article>
                                </div>
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