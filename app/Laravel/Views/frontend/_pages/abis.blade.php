 @extends('frontend._layout.main')

@section('content')       
        <div id="page-content" class="page-wrapper">
            <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
                <div class="container">
                    <div class="container">
                                <div class="row">
                                    <ul class="breadcrumb">
                                        <li class="completed"><a href="{{route('frontend.index')}}">Home</a></li>
                                        <li class="active"><a class="active-bread-crumb">ABIS</a></li>
                                    </ul>
                                </div>
                            </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 columns">
                            <div class="row mb-40">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h2 class="h6 header-color inline-block uppercase">ABIS Detail</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <article class="zm-post-lay-single">
                                        <div class="zm-post-dis">
                                            
                                            <div class="zm-post-content">
                                                @foreach($page_content as $index => $info)
                                                @if($info->page_location == 'abis')
                                                {!!$info->content!!}
                                                @endif
                                                @endforeach

                                                <div class="zm-post-header"  style="padding-bottom: 30px;">
                                                <h2 class="zm-post-title h2"><a href="#">Supporting Organization</a></h2>
                                                </div>

                                                <div class="container" style="width: 100%;">
                                                    <div class="row">
                                                        <div class="panel-group" id="accordion">

                                                            @foreach($organizations as $index => $info)
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse{{$info->id}}" class="panel-title expand">
                                                                    <div class="right-arrow pull-right">+</div>
                                                                    <a href="#">{{$info->title}}</a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapse{{$info->id}}" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        {!!$info->description!!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div> 
                                                        <div class="zm-post-header">
                                                            <h2 class="zm-post-title h2"><a href="#">Press Releases - ASEAN Business &amp; Investment Summit</a></h2>
                                                            <div class="zm-post-meta">
                                                            </div>
                                                        </div>
                                                        <ul style="list-style: disc; padding-left: 30px;">
                                                            @foreach($press_releases as $index => $info)
                                                            <li><a href="#"><h4 class="pb-10">{{$info->title}}</h4></a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                        <!-- End left side -->
                        @include('frontend._components.side-bar')
                    </div>
                </div>
            </div>
        </div>
@stop