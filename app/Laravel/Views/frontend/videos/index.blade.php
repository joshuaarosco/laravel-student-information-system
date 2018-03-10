@extends('frontend._layout.main')

@section('content')
<div id="page-content" class="page-wrapper">
    <div class="zm-section bg-white pt-70 pb-40" style="transform: none;">
        <div class="container" style="transform: none;">
            <div class="row" style="transform: none;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 columns" style="position: relative; box-sizing: border-box; min-height: 0px;">
                    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 0px; left: 291.5px;"><div class="row mb-40">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="container cont-2" style="padding-bottom: 50px;">
                                <div class="row mb-40">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="section-title">
                                            <h2 class="h6 header-color inline-block uppercase">Featured Videos</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach($videos as $index => $info)
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
                                                <div class="zm-post-content">
                                                    <p>{{Str::limit(strip_tags($info->description),$limit = 50)}}
                                                    </p>
                                                </div>
                                            </div><!-- End single video post [video layout A] -->
                                            <button class="submit-button mt-20 inline-block" onclick="window.location.href='<?php echo route('frontend.videos.show',$info->id.'-'.Str::slug($info->title));?>'" style="width: 25% !important; margin: auto 0;" type="submit">View Video details</button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row hidden-xs">
            <div class="zm-pagination-wrap mt-30">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <nav class="zm-pagination ptb-40 text-center">
                                {!! $videos->links() !!}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop

@section('page-scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.zm-video-post').matchHeight();
    });
</script>
@stop