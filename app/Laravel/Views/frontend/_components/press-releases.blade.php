<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <aside class="zm-post-lay-a2-area">
        <div class="row mb-40">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pt-30">
                <div class="section-title">
                    <h2 class="h6 header-color inline-block uppercase">Press Releases - ASEAN Business Awards</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="zm-posts clearfix">
                @foreach($footer_press_releases as $index => $info)
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                    <article class="zm-post-lay-a2">
                        <div class="zm-post-thumb">
                            <a href="{{route('frontend.press.show',$info->id.'-'.Str::slug($info->title))}}"><img src="{{asset($info->directory.'/'.$info->filename)}}" alt="img"></a>
                        </div>
                        <div class="zm-post-dis">
                            <div class="zm-post-header">
                                <h2 class="zm-post-title h2"><a href="#">{{$info->title}}</a></h2>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </aside>
</div>