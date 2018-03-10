@extends('frontend._layout.main')

@section('content')
        <div class="page-wrapper" id="page-content">
            <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
                <div class="container">
                    <div class="container">
                        <div class="row">
                            <ul class="breadcrumb">
                                <li class="completed">
                                    <a href="{{route('frontend.index')}}">Home</a>
                                </li>
                                <li class="active">
                                    <a class="active-bread-crumb">Partners</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="position: relative; box-sizing: border-box; min-height: 0px;">
                            <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static;">
                                <div class="row mb-40">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="section-title">
                                            <h2 class="h6 header-color inline-block uppercase">ABAC STRATEGIC PARTNERS</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End left side -->
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="zm-posts">
                        <!-- Start single post layout C -->
                        @foreach($partners as $index => $info)
                        <article class="zm-post-lay-c zm-single-post clearfix">
                            <div class="zm-post-thumb f-left">
                                <a><img alt="img" src="{{asset($info->directory.'/'.$info->filename)}}"></a>
                            </div>
                            <div class="zm-post-dis f-right">
                                <div class="zm-post-header">
                                    <h2 class="zm-post-title"><a href="#">{{$info->title}}</a></h2>
                                    <div class="zm-post-content">
                                        {{$info->content}}
                                    </div>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
                @include('frontend._components.side-bar')
            </div>
        </div>
@stop

@section('page-scripts')
<script type="text/javascript">
   $(function() {
     $(".expand").on( "click", function() {
             // $(this).next().slideToggle(200);
             $expand = $(this).find(">:first-child");
             
             if($expand.text() == "+") {
                 $expand.text("-");
             } else {
                 $expand.text("+");
             }
         });
 });
</script> 
@stop