@extends('frontend._layout.main')

@section('content')
        <div id="page-content" class="page-wrapper">
            <div class="zm-section bg-white pt-70 pb-40" style="transform: none;">
                <div class="container" style="transform: none;">
                    <div class="row" style="transform: none;">
                        <!-- Start left side -->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 columns" style="position: relative; box-sizing: border-box; min-height: 0px;">


                            <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 0px; left: 291.5px;"><div class="row mb-40">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h2 class="h6 header-color inline-block uppercase">News</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="zm-posts clearfix">
                                    <!-- End single post layout A1 -->
                                    <!-- Start single post layout A1 -->
                                    @foreach($news as $index => $info)
                                    <div class="col-md-4 col-sm-4">
                                        <article class="zm-post-lay-a1">
                                            <div class="zm-post-thumb">
                                                <a href="{{route('frontend.news.show',$info->id.'-'.Str::slug($info->title))}}"><img src="{{asset($info->directory.'/'.$info->filename)}}" alt="img" class="pt-40"></a>
                                            </div>
                                            <div class="zm-post-dis">
                                                <div class="zm-post-header">
                                                    <h2 class="zm-post-title h2"><a href="{{route('frontend.news.show',$info->id.'-'.Str::slug($info->title))}}">{{$info->title}}</a></h2>
                                                    <div class="zm-post-meta">
                                                        <ul>
                                                            <li class="s-meta">{{$info->author}}</li>
                                                            <li class="s-meta">{{Helper::date_format($info->posted_at,'F d, Y')}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="zm-post-content">
                                                    <p>{!!Str::limit(strip_tags($info->content),$limit = 100)!!}</p>
                                                </div>
                                                <a href="{{route('frontend.news.show',$info->id.'-'.Str::slug($info->title))}}">
                                                    <button class="submit-button mt-20 inline-block" type="submit" style="width: 100% !important;">View Post</button>
                                                </a>
                                                </div>
                                            </article>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End left side -->
                    </div>
                    <!-- Start pagination area -->
                    <div class="row hidden-xs">
                        <div class="zm-pagination-wrap mt-30">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <nav class="zm-pagination ptb-40 text-center">
                                            {!! $news->links() !!}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End pagination area -->
                    <!-- Start Advertisement -->
                    {{-- <div class="advertisement">
                        <div class="row mt-40">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                <a href="#"><img src="{{asset('frontend/images/ad/1.jpg')}}" alt=""></a>
                            </div>
                        </div>
                    </div> --}}
                    <!-- End Advertisement -->
                </div>
            </div>
        </div>
@stop