@extends('frontend._layout.main')

@section('content')
        <div class="page-wrapper" id="page-content">
            <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
                <div class="container">
                    <div class="container">
                        <div class="row">
                            <ul class="breadcrumb">
                                <li class="completed">
                                    <a href="{{route('frontend.index')}}">Home</a>
                                </li>
                                <li class="active">
                                    <a class="active-bread-crumb">PUBLICATIONS</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Start left side -->
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 columns">
                            <div class="row mb-40">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h2 class="h6 header-color inline-block uppercase">ASEAN BAC PUBLICATIONS</h2>
                                    </div>
                                </div>
                            </div><!-- File list -->
                            <div class="row" style="padding-left: 20PX;">
                                <div class="list-group">
                                    @foreach($publications as $index => $info)
                                    <a class="list-group-item" download="" href="{{asset($info->directory.'/'.$info->filename)}}">
                                        <div class="media col-md-3">
                                            <figure class="pull-left">
                                                <img alt="placehold.it/350x250" class="media-object img-rounded img-responsive" src="{{asset('frontend/images/general.png')}}">
                                            </figure>
                                        </div>
                                        <div class="col-md-6">
                                            <h4 class="list-group-item-heading pt-20">{{$info->title}}</h4>
                                            <p class="list-group-item-text">{{$info->description}}</p>
                                        </div>
                                        <div class="col-md-3 text-center pt-20">
                                            <button class="btn btn-default btn-lg btn-block" type="button" download="" href="{{asset($info->directory.'/'.$info->filename)}}"><i class="fa fa-download">&nbsp;</i>Download</button>
                                        </div>
                                    </a> 
                                    @endforeach
                                </div>
                            </div>
                        </div><!-- End left side -->
                        <!-- Start Right sidebar -->
                        @include('frontend._components.side-bar')
                    </div>
                </div>
            </div>
        </div>
@stop