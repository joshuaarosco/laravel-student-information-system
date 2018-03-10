@extends('frontend._layout.main')

@section('content')
<div id="page-content" class="page-wrapper">
    <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <h1 style="padding-bottom: 20px; padding-top: 20px;">{{$album->title}}</h1>
                    <div class="gal">
                        @forelse($album->photos as $index => $info)
                        <img src="{{asset($info->directory.'/'.$info->filename)}}" alt="">
                        @empty
                        No Photos uploaded yet
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('page-styles')
<style type="text/css">
.gal {


    -webkit-column-count: 3; /* Chrome, Safari, Opera */
    -moz-column-count: 3; /* Firefox */
    column-count: 3;


}   
.gal img{ width: 100%; padding: 7px 0;}
@media (max-width: 500px) {

    .gal {


        -webkit-column-count: 1; /* Chrome, Safari, Opera */
        -moz-column-count: 1; /* Firefox */
        column-count: 1;


    }

}
</style>
@stop

@section('page-scripts')
@stop