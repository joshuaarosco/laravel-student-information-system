@extends('frontend._layout.main')

@section('content')       
<div id="page-content" class="page-wrapper">
            <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
                <div class="container">
                    <div class="container">
                                <div class="row">
                                    <ul class="breadcrumb">
                                        <li class="completed"><a href="{{route('frontend.index')}}">Home</a></li>
                                        <li class="active"><a class="active-bread-crumb">Activities</a></li>
                                    </ul>
                                </div>
                            </div>
                    <div class="row">
                        <!-- Start left side -->
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 columns">
                            <div class="row mb-40">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h2 class="h6 header-color inline-block uppercase">ASEAN BAC ACTIVITIES</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Start single post image formate-->
                                <div class="col-md-12">
                                    <article class="zm-post-lay-single">
                                        <div class="zm-post-thumb">
                                            <a href="#"><img src="{{asset('frontend/images/post/single/activities.jpg')}}" alt="img" class="pb-30"></a>
                                        </div>
                                        <div class="zm-post-dis">
                                            <div class="zm-post-header">
                                                <h2 class="zm-post-title h2"><a href="#">ASEAN BUSINESS AWARDS</a></h2>
                                            </div>
                                            <div class="zm-post-content pb-20">
                                                <ol class="uls">
                                                    <li>ASEAN BAC organizes the annual ASEAN Business Awards (ABA) to recognize such outstanding and successful ASEAN companies contributing to ASEAN's economic growth and prosperity;</li>
                                                    <li>Aim of ABA is to recognize ASEAN companies which have contributed to the growth of the ASEAN economy, as well as showcase promising ASEAN SMEs which could be global players.</li>
                                                </ol>
                                            </div>
                                        </div>

                                        <div class="zm-post-dis">
                                            <div class="zm-post-header">
                                                <h2 class="zm-post-title h2"><a href="#">Award Categories</a></h2>
                                            </div>
                                            <div class="zm-post-content pb-30">
                                                <p class="pb-10">Winners of ABA are recognized as the “Most Admired ASEAN Enterprises” conferred in the following four categories:</p>
                                                <ul class="uls">
                                                    <li>Growth</li>
                                                    <li>Employment </li>
                                                    <li>Innovation </li>
                                                    <li>Corporate Social Responsibility (CSR)</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="zm-post-dis">
                                            <div class="zm-post-header">
                                                <h2 class="zm-post-title h2"><a href="#">ASEAN Business and Investment Summit</a></h2>
                                            </div>
                                            <div class="zm-post-content pb-30">
                                                <p class="pb-10">Winners of ABA are recognized as the “Most Admired ASEAN Enterprises” conferred in the following four categories:</p>
                                                <ul class="uls">
                                                    <li>The ASEAN Business and Investment Summit (ASEAN-BIS) is organized annually to coincide with the ASEAN Summit.</li>
                                                    <li>ASEAN BIS brings together private and public sector organizations, government representatives and captains of industry from within and outside ASEAN for dialogue and networking, and provides an interactive platform to advance industry and business in the region.</li>
                                                </ul>
                                            </div>
                                            <div class="zm-post-thumb">
                                            <a href="#"><img src="{{asset('frontend/images/post/single/activities-2.jpg')}}" alt="img" class="pb-30"></a>
                                            </div>
                                        </div>

                                        <!-- Asean Leaders -->
                                        <div class="zm-post-dis">
                                            <div class="zm-post-header">
                                                <h2 class="zm-post-title h2"><a href="#">ASEAN LEADERS AND ASEAN-BAC DIALOGUE</a></h2>
                                            </div>
                                            <div class="zm-post-content pb-30">
                                                <ul class="uls">
                                                    <li>10th ASEAN Leaders and ASEAN-BAC Dialogue - 17 November 2012, Phnom Penh,Cambodia</li>
                                                    <li>9th ASEAN Leaders and ASEAN-BAC Dialogue - 17 November 2011, Bali, Indonesia </li>
                                                    <li>8th ASEAN Leaders and ASEAN-BAC Dialogue - 28 October 2010, Hanoi, Vietnam</li>
                                                    <li>7th ASEAN Leaders and ASEAN-BAC Dialogue - 23 October 2009, Hua Hin, Thailand</li>
                                                    <li>6th ASEAN Leaders and ASEAN-BAC Dialogue - 28 February 2009, Hua Hin, Thailand</li>
                                                    <li>5th ASEAN Leaders and ASEAN-BAC Dialogue - 20 November 2007, Singapore </li>
                                                    <li>4th ASEAN Leaders and ASEAN-BAC Dialogue - 13 January 2007, Cebu, Philippines </li>
                                                    <li>3rd ASEAN Leaders and ASEAN-BAC Dialogue - 12 December 2005, Kuala Lumpur, Malaysia </li>
                                                    <li>2nd ASEAN Leaders and ASEAN-BAC Dialogue - 30 November 2004, Vientiane, Lao PDR </li>
                                                    <li>1st ASEAN Leaders and ASEAN-BAC Dialogue - 7 October 2003, Bali, Indonesia</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Image 2  -->
                                        <div class="zm-post-thumb">
                                            <a href="#"><img src="{{asset('frontend/images/post/single/activities-3.jpg')}}" alt="img" class="pb-30"></a>
                                        </div>

                                        <!-- AEM AND ASEAN-BAC CONSULTATION -->
                                        <div class="zm-post-dis">
                                            <div class="zm-post-header">
                                                <h2 class="zm-post-title h2"><a href="#">AEM AND ASEAN-BAC CONSULTATION</a></h2>
                                            </div>
                                            <div class="zm-post-content pb-30">
                                                <ul class="uls">
                                                    <li>10th AEM and ASEAN-BAC Consultation – 26 August 2012, Siem Reap, Manado</li>
                                                    <li>9th AEM and ASEAN-BAC Consultation – 13 August 2011, Manado, Indonesia</li>
                                                    <li>8th AEM and ASEAN-BAC Consultation - 25 August 2010, Danang, Vietnam </li>
                                                    <li>7th AEM and ASEAN-BAC Consultation - 22 October 2009, Hua Hin, Thailand </li>
                                                    <li>6th AEM and ASEAN-BAC Consultation - 13 August 2009, Bangkok, Thailand</li>
                                                    <li>5th AEM and ASEAN-BAC Consultation - 27 August 2008, Singapore </li>
                                                    <li>4th AEM and ASEAN-BAC Consultation - 24 August 2007, Manila, Philippines </li>
                                                    <li>3rd AEM and ASEAN-BAC Consultation - 22 August 2006, Kuala Lumpur, Malaysia </li>
                                                    <li>2nd AEM and ASEAN-BAC Consultation- 28 September 2005, Vientiane, Lao PDR</li>
                                                    <li>1st AEM and ASEAN-BAC Consultation - 3 September 2004, Jakarta, Indonesia</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </article>
                                </div>
                                <!--Start Similar post -->
                                @include('frontend._components.press-releases')
                                <!-- End similar post -->
                            </div>
                        </div>
                        <!-- End left side -->
                        @include('frontend._components.side-bar')
                        <!-- End Right sidebar -->
                    </div>
                </div>
            </div>
        </div>
@stop

@section('page-styles')
<style type="text/css">
.zm-post-header
{
    padding-top: 10px !important;
    padding-bottom: 30px !important;
}
</style>
@stop

@section('page-scripts')
@stop