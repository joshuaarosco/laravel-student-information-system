@extends('frontend._layout.main')

@section('content')
<div id="page-content" class="page-wrapper">
    <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
        <div class="container">
            <div class="container">
                <div class="row">
                    <ul class="breadcrumb">
                        <li class="completed"><a href="{{route('frontend.index')}}">Home</a></li>
                        <li class="active"><a href="{{route('frontend.press.index')}}">Press Release</a></li>
                        <li><a class="active-bread-crumb">{{$press_release->title}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 columns">
                    <div class="row mb-40">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="section-title">
                                <h2 class="h6 header-color inline-block uppercase">Press Release/Press Release Detail</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <article class="zm-post-lay-single">
                                <div class="zm-post-thumb">
                                    <img src="{{asset($press_release->directory.'/'.$press_release->filename)}}" alt="img">
                                </div>
                                <div class="zm-post-dis">
                                    <div class="zm-post-header">
                                        <h2 class="zm-post-title h2">{{$press_release->title}}</h2>
                                        <div class="zm-post-meta">
                                            <ul>
                                                <li class="s-meta">{{$press_release->author}}</li>
                                                <li class="s-meta">{{Helper::date_format($press_release->created_at,'F d, Y')}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="zm-post-content">
                                        {!!$press_release->content!!}
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                @include('frontend._components.side-bar')
            </div>
        </div>
    </div>
</div>
@stop