    <header class="header-area header-wrapper bg-white clearfix">
        <div class="header-top-bar bg-dark ptb-10">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 hidden-xs">
                        <div class="header-top-left">
                            <nav class="header-top-menu zm-secondary-menu">
                                <ul>
                                    <li>
                                        <a href="{{route('frontend.contact')}}">CONTACT US</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                        <div class="header-top-right clierfix text-right">
                            <div class="header-social-bookmark topbar-sblock">
                                <ul>
                                    @foreach($social_links as $index => $info)
                                    <li>
                                        <a href="{{$info->link}}" target="_blank"><i class="fa fa-{{$info->type}}"></i></a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="zmaga-calendar topbar-sblock">
                                <span class="calendar uppercase">{{Helper::date_format(Carbon::now(),'F d, Y')}}</span>
                            </div>
                            <div class="user-accoint topbar-sblock">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12 header-mdh">
                        <div class="global-table">
                            <div class="global-row">
                                <div class="global-cell">
                                    <div class="logo">
                                        <a href="{{route('frontend.index')}}"><img alt="" src="{{asset($logo->directory.'/'.$logo->filename)}}" height="100px"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-7 col-sm-6 col-xs-12 col-lg-offset-1 header-mdh">
                        <div class="carousel slide" id="myCarousel" style="margin-top: 20px;" >
                            <div class="carousel-inner">
                                @foreach($advertisements as $index => $info)
                                @if($info->type == 'head')
                                <div class="item {{$index+1 == 1 ? 'active' : NULL}}">
                                    <img class="img-responsive w-100" src="{{asset($info->directory.'/'.$info->filename)}}">
                                    <div class="container">
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div><!-- Controls -->
                             <a class="left carousel-control" data-slide="prev" href="#myCarousel"><span class="icon-prev"></span></a> <a class="right carousel-control" data-slide="next" href="#myCarousel"><span class="icon-next"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom-area bg-theme hidden-sm hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="menu-wrapper clearfix">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="mainmenu-area">
                                        <nav class="primary-menu uppercase">
                                            <ul class="clearfix">
                                                <li class="current-drop {{ active_class(if_route(['frontend.index']), 'current-drop-active') }}">
                                                    <a href="{{route('frontend.index')}}">Home</a>
                                                </li>
                                                <li class="drop {{ active_class(if_route(['frontend.aba']), 'current-drop-active') }}">
                                                    <a href="{{route('frontend.aba')}}">ABA</a>
                                                </li>
                                                <li class="drop {{ active_class(if_route(['frontend.abis']), 'current-drop-active') }}">
                                                    <a href="{{route('frontend.abis')}}">ABIS</a>
                                                </li>
                                                <li class="drop {{ active_class(if_route(['frontend.asean_bac']), 'current-drop-active') }}">
                                                    <a href="{{route('frontend.asean_bac')}}">ASEAN BAC</a>
                                                </li>
                                                <li class="drop {{ active_class(if_route(['frontend.members']), 'current-drop-active') }}">
                                                    <a href="{{route('frontend.members')}}">MEMBERS</a>
                                                </li>
                                                <li class="drop {{ active_class(if_route(['frontend.events.index','frontend.events.show']), 'current-drop-active') }}">
                                                    <a href="{{route('frontend.events.index')}}">EVENT CALENDAR</a>
                                                </li>
                                                <li class="drop {{ active_class(if_route(['frontend.partners.index']), 'current-drop-active') }}"><a>Partners</a>
                                                    <ul class="dropdown level2">
                                                        <li><a href="{{route('frontend.partners.index','platinum')}}">Platinum Partners</a></li>
                                                        <li><a href="{{route('frontend.partners.index','bronze')}}">Bronze Partners</a></li>
                                                    </ul>
                                                </li>
                                               <!--  <li class="drop {{ active_class(if_route(['frontend.news.index','frontend.news.show']), 'current-drop-active') }}">
                                                    <a href="{{route('frontend.news.index')}}">NEWS</a>
                                                </li> -->
                                                <li class="drop {{ active_class(if_route(['frontend.news.index']), 'current-drop-active') }}"><a>News</a>
                                                    <ul class="dropdown level2">
                                                        <li><a href="{{route('frontend.news.index')}}">News and Articles</a></li>
                                                        <li><a href="{{route('frontend.press.index')}}">Press Releases</a></li>
                                                    </ul>
                                                </li>
                                                <!-- <li class="drop {{ active_class(if_route(['frontend.gallery.index','frontend.gallery.show']), 'current-drop-active') }}">
                                                    <a href="{{route('frontend.gallery.index')}}">GALLERY</a>
                                                </li> -->
                                                <li class="drop {{ active_class(if_route(['frontend.partners.index']), 'current-drop-active') }}"><a>GALLERY</a>
                                                    <ul class="dropdown level2">
                                                        <li><a href="{{route('frontend.gallery.index')}}">Photo Gallery</a></li>
                                                        <li><a href="{{route('frontend.videos.index')}}">Video Gallery</a></li>
                                                    </ul>
                                                </li>
                                                <li class="drop {{ active_class(if_route(['frontend.publication']), 'current-drop-active') }}">
                                                    <a href="{{route('frontend.publication')}}">PUBLICATION</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                {{-- <div class="col-md-1">
                                    <div class="search-wrap pull-right">
                                        <div class="search-btn">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <div class="search-form">
                                            <form action="#">
                                                <input placeholder="Search" type="search"> <button type="submit"><i class="fa fa-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div
>        </div><!-- mobile-menu-area start -->
        <div class="mobile-menu-area hidden-md hidden-lg">
            <div class="fluid-container">
                <div class="mobile-menu clearfix">
                    {{-- <div class="search-wrap mobile-search">
                        <div class="mobile-search-btn">
                            <i class="fa fa-search"></i>
                        </div>
                        <div class="mobile-search-form">
                            <form action="#">
                                <input placeholder="Search" type="text"> <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div> --}}
                    <nav id="mobile_dropdown" style="display: block;">
                        <ul class="clearfix">
                            <li class="current-drop {{ active_class(if_route(['frontend.index']), 'current-drop-active') }}">
                                <a href="{{route('frontend.index')}}">Home</a>
                            </li>
                            <li class="drop {{ active_class(if_route(['frontend.aba']), 'current-drop-active') }}">
                                <a href="{{route('frontend.aba')}}">ABA</a>
                            </li>
                            <li class="drop {{ active_class(if_route(['frontend.abis']), 'current-drop-active') }}">
                                <a href="{{route('frontend.abis')}}">ABIS</a>
                            </li>
                            <li class="drop {{ active_class(if_route(['frontend.asean_bac']), 'current-drop-active') }}">
                                <a href="{{route('frontend.asean_bac')}}">ASEAN BAC</a>
                            </li>
                            <li class="drop {{ active_class(if_route(['frontend.members']), 'current-drop-active') }}">
                                <a href="{{route('frontend.members')}}">MEMBERS</a>
                            </li>
                            <li class="drop {{ active_class(if_route(['frontend.events.index','frontend.events.show']), 'current-drop-active') }}">
                                <a href="{{route('frontend.events.index')}}">CALENDAR</a>
                            </li>
                            <li class="drop {{ active_class(if_route(['frontend.partners.index']), 'current-drop-active') }}"><a href="#">Partners</a>
                                <ul class="dropdown level2">
                                    <li><a href="{{route('frontend.partners.index','platinum')}}">Platinum Partners</a></li>
                                    <li><a href="{{route('frontend.partners.index','bronze')}}">Bronze Partners</a></li>
                                </ul>
                            </li>
                            <li class="drop {{ active_class(if_route(['frontend.news.index','frontend.news.show']), 'current-drop-active') }}">
                                <a href="{{route('frontend.news.index')}}">NEWS</a>
                            </li>
                            <li class="drop {{ active_class(if_route(['frontend.gallery.index','frontend.gallery.show']), 'current-drop-active') }}">
                                <a href="{{route('frontend.gallery.index')}}">GALLERY</a>
                            </li>
                            <li class="drop {{ active_class(if_route(['frontend.publication']), 'current-drop-active') }}">
                                <a href="{{route('frontend.publication')}}">PUBLICATION</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div><!-- mobile-menu-area end -->

        <!-- Flags -->
        <div>
            <div class="container center-block" style="padding-top: 10px; padding-bottom: 10px;">
                <div class="row">
                    <div class="col-md-1">
                    </div>
                    @foreach($flags as $index => $info)
                    <a href="{{$info->url}}" target="_blank">
                    <div class="col-md-1 col-sm-2 col-xs-2 hvr-wobble-vertical" title="{{$info->title}}">
                        <img src="{{asset($info->directory.'/'.$info->filename)}}">
                    </div>
                    </a>
                    @endforeach
                    <div class="col-md-1">
                    </div>
                </div>
                </a>
            </div>
        </div>

        <div class="breakingnews-wrapper bg-gray hidden-xs">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                        <div class="breakingnews clearfix fix">
                            <div class="bn-title">
                                <h6 class="uppercase">BREAKING NEWS</h6>
                            </div>
                            <div class="news-wrap">
                                <ul class="bkn clearfix" id="bkn">
                                    @foreach($news as $index => $info)
                                    <li style="display: list-item;">
                                        {{$info->title}}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>