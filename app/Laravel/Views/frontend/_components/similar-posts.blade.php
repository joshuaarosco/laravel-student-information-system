<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <aside class="zm-post-lay-a2-area">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-title mb-40">
                    <h2 class="h6 inline-block">Similar News For You</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="zm-posts clearfix">
                @foreach($similar_posts as $index => $info)
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                    <article class="zm-post-lay-a2">
                        <div class="zm-post-thumb">
                            <a href="{{route('frontend.news.show',$info->id.'-'.Str::slug($info->title))}}"><img src="{{asset($info->directory.'/'.$info->filename)}}" alt="img"></a>
                        </div>
                        <div class="zm-post-dis">
                            <div class="zm-post-header">
                                <h2 class="zm-post-title h2"><a href="{{route('frontend.news.show',$info->id.'-'.Str::slug($info->title))}}">{{$info->title}}</a></h2>
                                <div class="zm-post-meta">
                                    <ul>
                                        <li class="s-meta">{{$info->author}}</li>
                                        <li class="s-meta">{{Helper::date_format($info->created_at,'F d, Y')}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
                {{-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                    <article class="zm-post-lay-a2">
                        <div class="zm-post-thumb">
                            <a href="#"><img src="{{asset('frontend/images/post/a/a2/2.jpg')}}" alt="img"></a>
                        </div>
                        <div class="zm-post-dis">
                            <div class="zm-post-header">
                                <h2 class="zm-post-title h2"><a href="#">Lorem ipsum dolor sit amet consectetur.</a></h2>
                                <div class="zm-post-meta">
                                    <ul>
                                        <li class="s-meta"><a href="#" class="zm-author">Thomson Smith</a></li>
                                        <li class="s-meta"><a href="#" class="zm-date">April 18, 2016</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 hidden-md hidden-sm">
                    <article class="zm-post-lay-a2">
                        <div class="zm-post-thumb">
                            <a href="#"><img src="{{asset('frontend/images/post/a/a2/13.jpg')}}" alt="img"></a>
                        </div>
                        <div class="zm-post-dis">
                            <div class="zm-post-header">
                                <h2 class="zm-post-title h2"><a href="#">Lorem ipsum dolor sit amet consectetur.</a></h2>
                                <div class="zm-post-meta">
                                    <ul>
                                        <li class="s-meta"><a href="#" class="zm-author">Thomson Smith</a></li>
                                        <li class="s-meta"><a href="#" class="zm-date">April 18, 2016</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </article>
                </div> --}}
            </div>
        </div>
    </aside>
</div>