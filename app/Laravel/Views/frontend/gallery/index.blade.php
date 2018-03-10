@extends('frontend._layout.main')

@section('content')
<div id="page-content" class="page-wrapper">
    <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
        <div class="container" style="transform: none;">
            <div class="row" style="transform: none;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 columns" style="position: relative; box-sizing: border-box; min-height: 0px;">

                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static;">
                        <div class="row mb-40">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="section-title">
                                    <h2 class="h6 header-color inline-block uppercase">ABAC ALBUMS</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="zm-posts clearfix">
                                @foreach($albums as $index => $info)
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                                    <article class="zm-trending-post zm-lay-a1 zm-single-post" data-effict-zoom="1">
                                        <div class="zm-post-thumb">
                                            <a href="{{route('frontend.gallery.show',$info->id.'-'.Str::slug($info->title))}}" data-dark-overlay="2.5" data-scrim-bottom="9">
                                                <img src="{{asset($info->directory.'/'.$info->filename)}}" alt="img">
                                            </a>
                                        </div>
                                        <div class="zm-post-dis text-white">
                                            <h2 class="zm-post-title h3">
                                                <a href="{{route('frontend.gallery.show',$info->id.'-'.Str::slug($info->title))}}">{{$info->title}}</a>
                                            </h2>
                                            <div class="zm-post-meta">
                                                <ul>
                                                    <li class="s-meta">({{count($info->photos)}}) Photos</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop