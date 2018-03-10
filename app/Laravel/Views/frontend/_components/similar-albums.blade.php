<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
    <aside class="zm-post-lay-a2-area">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-title mb-40">
                    <h2 class="h6 inline-block">Similar Albums</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($similar_albums as $index => $info)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding-bottom: 10px;">
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
            {{-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding-bottom: 10px;">
                <article class="zm-trending-post zm-lay-a1 zm-single-post" data-effict-zoom="1">
                    <div class="zm-post-thumb">
                        <a href="{{route('frontend.gallery.show',$info->id.'-'.Str::slug($info->title))}}" data-dark-overlay="2.5" data-scrim-bottom="9"><img src="{{asset('frontend/images/post/trend/b/2.jpg')}}" alt="img"></a>
                    </div>
                    <div class="zm-post-dis text-white">
                        <h2 class="zm-post-title h3"><a href="{{route('frontend.gallery.show',$info->id.'-'.Str::slug($info->title))}}">ALBUM TITLE HERE</a></h2>
                        <div class="zm-post-meta">
                            <ul>
                                <li class="s-meta">(12) Photos</li>
                            </ul>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding-bottom: 10px;">
                <article class="zm-trending-post zm-lay-a1 zm-single-post" data-effict-zoom="1">
                    <div class="zm-post-thumb">
                        <a href="{{route('frontend.gallery.show',$info->id.'-'.Str::slug($info->title))}}" data-dark-overlay="2.5" data-scrim-bottom="9"><img src="{{asset('frontend/images/post/trend/b/5.jpg')}}" alt="img"></a>
                    </div>
                    <div class="zm-post-dis text-white">
                        <h2 class="zm-post-title h3"><a href="{{route('frontend.gallery.show',$info->id.'-'.Str::slug($info->title))}}">ALBUM TITLE HERE</a></h2>
                        <div class="zm-post-meta">
                            <ul>
                                <li class="s-meta">(12) Photos</li>
                            </ul>
                        </div>
                    </div>
                </article>
            </div> --}}
        </div>
    </aside>
</div>