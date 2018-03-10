@extends('frontend._layout.main')

@section('content')
        <div id="page-content" class="page-wrapper">
            <div class="zm-section bg-white pt-70 pb-40" style="transform: none;">
                <div class="container" style="transform: none;">
                    <div class="row" style="transform: none;">
                        <!-- Start left side -->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 columns" style="position: relative; box-sizing: border-box; min-height: 0px;">
                            <div class="row">
                                @include('frontend._components.press-releases')
                                </div>
                            </div>
                        </div>
                        <!-- End left side -->
                    </div>
                    <!-- Start pagination area -->
                </div>
            </div>
        </div>
@stop