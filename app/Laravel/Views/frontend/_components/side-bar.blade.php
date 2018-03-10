<!-- Start Right sidebar -->
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 sidebar-warp columns">
    <div class="row">
        <!-- Start Subscribe From -->
        <div class="col-md-6 col-sm-6 col-lg-12 mt-60 sm-mb-50">
            <aside class="subscribe-form bg-dark text-center sidebar hidden-md">
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
            </aside>
        </div>
        <!-- End Subscribe From -->
        @foreach($advertisements as $index => $info)
        @if($info->type == 'side')
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sidebar-warp columns pt-20">
            <div class="zm-post-thumb">
                <a href="{{$info->link?$info->link : '#'}}" {{$info->link?'target="_blank"' : '#'}}><img src="{{asset($info->directory.'/'.$info->filename)}}" alt="img"></a>
            </div>
        </div>
        @endif
        @endforeach

        <!-- Start post layout E -->
        <aside class="zm-post-lay-e-area col-md-12 col-sm-6 col-lg-12 mt-70 sm-mt-30">
            <div class="row mb-40">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="section-title">
                        <h2 class="h6 header-color inline-block uppercase">News and Articles</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="zm-posts">
                        @foreach($side_bar_news as $index => $info)
                        <article class="zm-post-lay-e zm-single-post clearfix">
                            <div class="zm-post-thumb f-left">
                                <a href="{{route('frontend.news.show',$info->id.'-'.Str::slug($info->title))}}"><img src="{{asset($info->directory.'/'.$info->filename)}}" alt="img"></a>
                            </div>
                            <div class="zm-post-dis f-right">
                                <div class="zm-post-header">
                                    <h2 class="zm-post-title"><a href="{{route('frontend.news.show',$info->id.'-'.Str::slug($info->title))}}">{{$info->title}}</a></h2>
                                    <div class="zm-post-meta">
                                        <ul>
                                            <li class="s-meta">{{Str::limit(strip_tags($info->content),$limit=50)}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
                        <!-- End Right sidebar -->