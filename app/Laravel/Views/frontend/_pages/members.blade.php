@extends('frontend._layout.main')

@section('content')
        <div id="page-content" class="page-wrapper">
            <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
                <div class="container">
                    <div class="container">
                                <div class="row">
                                    <ul class="breadcrumb">
                                        <li class="completed"><a href="{{route('frontend.index')}}">Home</a></li>
                                        <li class="active"><a class="active-bread-crumb">Members</a></li>
                                    </ul>
                                </div>
                            </div>
                    <div class="row">
                        <!-- Start left side -->
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 columns">
                            <div class="row mb-40">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h2 class="h6 header-color inline-block uppercase">ABAC Members</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Start single post image formate-->
                                <div class="col-md-12">
                                    <article class="zm-post-lay-single">
                                        <div class="zm-post-dis">
                                           @foreach($page_content as $index => $info)
                                           @if($info->page_location == 'members')
                                           {!!$info->content!!}
                                           @endif
                                           @endforeach
                                            <div class="zm-post-content">

                                                <div class="zm-post-header"  style="padding-bottom: 30px;">
                                                <h2 class="zm-post-title h2"><a href="#">Members of ASEAN BAC</a></h2>
                                                </div>

                                                <!-- Members -->
                                                <div class="row mb-40 pt-20">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <div class="section-title">
                                                            <h2 class="h6 header-color inline-block uppercase">Members</h2>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="container" style="width: 100%;">
                                                    <div class="row">
                                                        <div class="panel-group" id="accordion">
                                                            @foreach($members as $index => $info)
                                                            @if($info->member_type == 'member')
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse{{$info->id}}" class="panel-title expand">
                                                                        <div class="right-arrow pull-right">+</div>
                                                                        {{$info->title}}
                                                                    </h4>
                                                                </div>
                                                                <div id="collapse{{$info->id}}" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        {!!$info->details!!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div> 
                                                    </div>
                                                </div>

                                                <!-- Founding Members -->
                                                <div class="row mb-40 pt-20">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <div class="section-title">
                                                            <h2 class="h6 header-color inline-block uppercase">Founding Members</h2>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="container" style="width: 100%;">
                                                    <div class="row">
                                                        <div class="panel-group" id="accordion2">
                                                            @foreach($members as $index => $info)
                                                            @if($info->member_type == 'founding_member')
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 data-toggle="collapse" data-parent="#accordion2" href="#collapse{{$info->id}}" class="panel-title expand">
                                                                        <div class="right-arrow pull-right">+</div>
                                                                        {{$info->title}}
                                                                    </h4>
                                                                </div>
                                                                <div id="collapse{{$info->id}}" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        {!!$info->details!!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div> 
                                                    </div>
                                                </div>

                                                <!-- Lead Staffers -->
                                                <div class="row mb-40 pt-20">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                        <div class="section-title">
                                                            <h2 class="h6 header-color inline-block uppercase">Lead Staffers</h2>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="container" style="width: 100%;">
                                                    <div class="row">
                                                        <div class="panel-group" id="accordion3">
                                                            @foreach($members as $index => $info)
                                                            @if($info->member_type == 'lead_staffers')
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 data-toggle="collapse" data-parent="#accordion3" href="#collapse{{$info->id}}" class="panel-title expand">
                                                                        <div class="right-arrow pull-right">+</div>
                                                                        {{$info->title}}
                                                                    </h4>
                                                                </div>
                                                                <div id="collapse{{$info->id}}" class="panel-collapse collapse">
                                                                    <div class="panel-body">
                                                                        {!!$info->details!!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div> 
                                                    </div>
                                                </div>
                                        </article>
                                </div>

                                @include('frontend._components.press-releases')
                            </div>
                        </div>
                        <!-- End left side -->

                        @include('frontend._components.side-bar')
                    </div>
                </div>
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