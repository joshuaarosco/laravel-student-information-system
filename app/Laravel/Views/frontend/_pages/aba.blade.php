@extends('frontend._layout.main')

@section('content')
<div id="page-content" class="page-wrapper">
    <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
        <div class="container">
            <div class="container">
                <div class="row">
                    <ul class="breadcrumb">
                        <li class="completed"><a href="{{route('frontend.index')}}">Home</a></li>
                        <li class="active"><a class="active-bread-crumb">ABA</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <!-- Start left side -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 columns">
                    <div class="row mb-40">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="section-title">
                                <h2 class="h6 header-color inline-block uppercase">ABA Detail</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Start single post image formate-->
                        <div class="col-md-12">
                            <article class="zm-post-lay-single">
                                @foreach($page_content as $index => $info)
                                @if($info->page_location == 'aba')
                                {!!$info->content!!}
                                @endif
                                @endforeach
                            </article>
                        </div>
                        <!-- End single post image formate -->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <nav class="zm-pagination ptb-40 mtb-40 text-center border-bottom border-top">
                            </nav>
                        </div>

                        @include('frontend._components.similar-posts')
                        
                        @include('frontend._components.similar-albums')
                    </div>
                </div>
                <!-- End left side -->
                @include('frontend._components.side-bar')
            </div>
        </div>
    </div>
</div>
@stop