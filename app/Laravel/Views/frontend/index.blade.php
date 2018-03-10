@extends('frontend._layout.main')

@section('content')
<div class="trending-post-area">
    <div class="container-fluid">
        <div class="row">
            <div class="trend-post-list zm-lay-c-wrap zm-posts clearfix">
                <!-- Start single trend post -->
                <div class="col-md-6 col-sm-12 col-xs-12 p-0">
                    <div class="carousel slide" id="myCarousel2">
                        <div class="carousel-inner">
                            @foreach($header_images as $index => $info)
                            <div class="item {{$index+1 == 1? 'active' : NULL}}">
                                <img class="img-responsive w-100" src="{{asset($info->directory.'/'.$info->filename)}}">
                                <div class="container">
                                </div>
                            </div>
                            @endforeach
                        </div><!-- Controls -->
                        <a class="left carousel-control" data-slide="prev" href="#myCarousel2"><span class="icon-prev"></span></a> <a class="right carousel-control" data-slide="next" href="#myCarousel2"><span class="icon-next"></span></a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="row">
                    @foreach($featured_news as $info)
                        <div class="col-md-6 col-sm-6 p-0">
                            <article class="zm-trending-post zm-lay-c zm-single-post" data-dark-overlay="2.5" data-effict-zoom="1" data-scrim-bottom="9">
                                <div class="zm-post-thumb"><img alt="img" src="{{asset($info->directory.'/'.$info->filename)}}"></div>
                                <div class="zm-post-dis text-white">
                                    <h2 class="zm-post-title"><a href="{{route('frontend.news.show',$info->id.'-'.Str::slug($info->title))}}">{{$info->title}}</a></h2>
                                    <div class="zm-post-meta">
                                        <ul>
                                            <li class="s-meta">
                                                {{Helper::date_format($info->posted_at,'F d, Y')}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                    </div>
                </div><!-- End single trend post -->
            </div>
        </div>
    </div>
</div><!-- End trending post area -->
<!-- Start page content -->
<section class="page-wrapper" id="page-content">
    <div class="zm-section bg-white pt-70 pb-40">
        <!-- VIDEO -->
        <div class="container cont-2" style="padding-bottom: 50px;">
            <div class="row mb-40">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-title">
                        <h2 class="h6 header-color inline-block uppercase">Featured Videos</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($featured_videos as $index => $info)
                <div class="col-md-6">
                    <div class="zm-video-post-list zm-posts clearfix">
                        <!-- Start single video post [video layout A] -->
                        <div class="zm-video-post zm-video-lay-b zm-single-post">
                            <div class="zm-video-thumb" data-dark-overlay="2.5">
                                <img alt="video" src="{{asset($info->directory.'/'.$info->filename)}}"> <a class="video-activetor img-responsive" href="{{$info->embedded_link}}"><i class="fa fa-play-circle-o"></i></a>
                            </div>
                            <div class="zm-video-info text-white">
                                <h2 class="zm-post-title">{{$info->title}}</h2>
                                <div class="zm-post-meta"></div>
                            </div>
                        </div><!-- End single video post [video layout A] -->
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-12 text-center">
                <button class="submit-button mt-20 inline-block" onclick="window.location.href='<?php echo route('frontend.gallery.index');?>'" style="width: 25% !important; margin: auto 0;" type="submit">View All Featured Videos</button>
            </div>
        </div>
        <div class="container cont-2" style="transform: none;">
            <div class="row" style="transform: none;">
                <!-- Start left side -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 columns" style="position: relative; box-sizing: border-box; min-height: 0px;">
                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 0px;">
                        <div class="row mb-40">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="section-title">
                                    <h2 class="h6 header-color inline-block uppercase">News And Articles</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="zm-posts clearfix">
                                @foreach($news as $index => $info)
                                <div class="col-md-12 col-lg-6 col-sm-12">
                                    <article class="zm-post-lay-a1">
                                        <div class="zm-post-thumb">
                                            <a href="{{route('frontend.news.show',$info->id.'-'.Str::slug($info->title))}}"><img alt="img" src="{{asset($info->directory.'/'.$info->filename)}}"></a>
                                        </div>
                                        <div class="zm-post-dis">
                                            <div class="zm-post-header">
                                                <h2 class="zm-post-title h2"><a href="{{route('frontend.news.show',$info->id.'-'.Str::slug($info->title))}}">{{$info->title}}</a></h2>
                                                <div class="zm-post-meta">
                                                    <ul>
                                                        <li class="s-meta">
                                                            {{$info->author}}
                                                        </li>
                                                        <li class="s-meta">
                                                            {{Helper::date_format($info->posted_at,'F d, Y')}}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="zm-post-content">
                                                <p>{{strip_tags($info->excerpt)}}</p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                @endforeach
                                <button class="submit-button mt-20 inline-block" onclick="window.location.href='<?php echo route('frontend.news.index');?>'" style="width: 50% !important; margin: auto 0;" type="submit">View All News</button> <!-- End single post layout A1 -->
                            </div>
                        </div>
                    </div>
                </div><!-- End left side -->
                <!-- Start Right sidebar -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-sm sidebar-warp columns" style="position: relative; box-sizing: border-box; min-height: 0px;">
                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static;">
                        <div class="row">
                            <!-- Start Subscribe From -->
                            <div class="col-md-12 col-lg-12">
                                <aside class="subscribe-form bg-dark text-center sidebar">
                                    <h3 class="uppercase zm-post-title">Get Email Updates</h3>
                                    <p>Join 80,000+ awesome subscribers and update yourself with our exclusive news.</p>
                                    @if(Session::get('notification-status') == "success")
                                    <div role="alert" class="alert alert-success alert-icon alert-icon-border alert-dismissible">
                                        <div class="icon"><span class="mdi mdi-check"></span></div>
                                        <div class="message">
                                            <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>
                                            <strong>{{Session::get('notification-title',"Success")}}!</strong> {!! Session::get('notification-msg') !!}
                                        </div>
                                    </div>
                                    @endif
                                    <form action="{{route('frontend.subscription')}}" method="POST">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input placeholder="Enter your full name" type="text" required="" name="name">
                                        <input placeholder="Enter email address" type="email" required="" name="email">
                                        <input value="Subscribe" type="submit">
                                    </form>
                                    <p style="font-size: 10px;">By clicking subscribe you agree to terms and condition of ABAC.</p>
                                </aside>
                            </div><!-- End Subscribe From -->
                            <!-- Start post layout E -->
                            <aside class="zm-post-lay-e-area col-md-12 col-lg-12 mt-60">
                                <div class="row mb-40">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="section-title">
                                            <h2 class="h6 header-color inline-block uppercase">Upcoming Events</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="zm-posts">

                                            @foreach($events as $index => $info)
                                            <article class="zm-post-lay-e zm-single-post clearfix">
                                                <div class="zm-post-thumb f-left">
                                                    <a href="{{route('frontend.events.show',$info->id.'-'.Str::slug($info->title))}}"><img alt="img" src="{{asset($info->directory.'/'.$info->filename)}}"></a>
                                                </div>
                                                <div class="zm-post-dis f-right">
                                                    <div class="zm-post-header">
                                                        <h2 class="zm-post-title"><a href="{{route('frontend.events.show',$info->id.'-'.Str::slug($info->title))}}">{{$info->title}}</a></h2>
                                                        <div class="zm-post-meta">
                                                            <ul>
                                                                <li class="s-meta">
                                                                    {{Helper::date_format($info->created_at,'F d, Y')}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                            @endforeach

                                            <button class="submit-button mt-20" onclick="window.location.href='<?php echo route('frontend.events.index');?>'" type="submit">See Full Calendar</button>
                                        </div>
                                    </div>
                                </div>
                            </aside><!-- Start post layout E -->


                            <aside class="zm-post-lay-a-area col-md-12 col-lg-12 hidden-sm xs-mt-40 pt-30">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="zm-posts">
                                            <article class="zm-post-lay-a sidebar">
                                                @foreach($advertisements as $index => $info)
                                                <div class="zm-post-thumb pb-20">
                                                    <a href="{{$info->link?$info->link : '#'}}" {{$info->link?'target="_blank"' : '#'}}><img src="{{asset($info->directory.'/'.$info->filename)}}" alt="img"></a>
                                                </div>
                                                @endforeach
                                            </article>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row mt-70">
                                    <div class="col-lg-12 col-sm-6 col-md-6 xs-mt-50">
                                        <!-- Start Follow Us area -->
                                        <div class="row mb-40 bug-fix-section-title-2">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="section-title">
                                                    <h2 class="h6 header-color inline-block uppercase">Follow Us</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="followus-area">
                                                    <a class="social-btn large bg-facebook block" href="#"><span class="btn_text"><i class="fa fa-facebook"></i>336,784 Likes</span></a> <a class="social-btn large bg-twitter block" href="#"><span class="btn_text"><i class="fa fa-twitter"></i>548,266 Followers</span></a> <a class="social-btn large bg-instagram block" href="#"><span class="btn_text"><i class="fa fa-instagram"></i>548,266 Followers</span></a> <a class="social-btn large bg-youtube block" href="#"><span class="btn_text"><i class="fa fa-youtube-play"></i>806,457 Subscribers</span></a>
                                                </div>
                                            </div>
                                        </div><!-- End Follow Us area -->
                                    </div>
                                </div> --}}

                            </aside>
                        </div>
                    </div>
                </div><!-- End Right sidebar -->
            </div>
        </div>


        <div class="container cont-2" style="padding-top: 70px; padding-right: 0px; padding-left: 0px;">
            <div class="row">
                <!-- Start left side -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 columns" style="position: relative; box-sizing: border-box; min-height: 0px;">

                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static;"><div class="row mb-40">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="section-title">
                                <h2 class="h6 header-color inline-block uppercase">ABAC ALBUMS</h2>
                            </div>
                        </div>
                    </div>

                    <div class="zm-posts clearfix">

                        @foreach($albums as $index => $info)
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 pad-zero">
                            <article class="zm-trending-post zm-lay-a1 zm-single-post" data-effict-zoom="1">
                                <div class="zm-post-thumb">
                                <a href="{{route('frontend.gallery.show',$info->id.'-'.Str::slug($info->title))}}" data-dark-overlay="2.5" data-scrim-bottom="9"><img src="{{asset($info->directory.'/'.$info->filename)}}" alt="img"></a>
                                </div>
                                <div class="zm-post-dis text-white">
                                    <h2 class="zm-post-title h3"><a href="{{route('frontend.gallery.show',$info->id.'-'.Str::slug($info->title))}}">{{$info->title}}</a></h2>
                                    <div class="zm-post-meta">
                                        <ul>
                                            <li class="s-meta">({{count($info->photos)}}) Photos</li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                        @endforeach
                        
                        <div class="col-md-12 text-center">
                            <button class="submit-button mt-20 inline-block" onclick="window.location.href='<?php echo route('frontend.gallery.index');?>'" style="width: 25% !important; margin: auto 0;" type="submit">View All Albums</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</section>
@stop

@section('page-styles')
<style type="text/css">
@media (min-width: 1366px)
{
    .cont-2 {
        width: 95%;
    }
</style>
@stop

@section('page-scripts')
<script type="text/javascript">
 $(document).ready(function() {
   $('#media').carousel({
     pause: true,
     interval: false,
 });
});
</script>
@stop