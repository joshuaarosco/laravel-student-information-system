@extends('frontend._layout.main')

@section('content')
        <div id="page-content" class="page-wrapper">
            <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
                <div class="container">
                    <div class="container">
                                <div class="row">
                                    <ul class="breadcrumb">
                                        <li class="completed"><a href="{{route('frontend.index')}}">Home</a></li>
                                        <li class="active"><a href="{{route('frontend.news.index')}}">News</a></li>
                                        <li><a class="active-bread-crumb">{{$current_news->title}}</a></li>
                                    </ul>
                                </div>
                            </div>
                    <div class="row">
                        <!-- Start left side -->
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 columns">
                            <div class="row mb-40">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h2 class="h6 header-color inline-block uppercase">News/Article Detail</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Start single post image formate-->
                                <div class="col-md-12">
                                    <article class="zm-post-lay-single">
                                        <div class="zm-post-thumb">
                                            <a href="#"><img src="{{asset($current_news->directory.'/'.$current_news->filename)}}" alt="img"></a>
                                        </div>
                                        <div class="zm-post-dis">
                                            <div class="zm-post-header">
                                                <h2 class="zm-post-title h2">{{$current_news->title}}</h2>
                                                <div class="zm-post-meta">
                                                    <ul>
                                                        <li class="s-meta">{{$current_news->author}}</li>
                                                        <li class="s-meta">{{Helper::date_format($current_news->posted_at,'F d, Y')}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="zm-post-content">
                                                {!!$current_news->content!!}
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <!-- End single post image formate -->
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <nav class="zm-pagination ptb-40 mtb-40 text-center border-bottom border-top">
                                        {{-- <ul class="page-numbers clearfix">
                                            <li class=" pull-left"><a class="prev page-numbers" href="#">Previous</a></li>
                                            <li class="pull-right"><a class="next page-numbers" href="#">Next</a></li>
                                        </ul> --}}
                                    </nav>
                                </div>
                                <!--Start Similar post -->
                                @include('frontend._components.similar-posts')
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