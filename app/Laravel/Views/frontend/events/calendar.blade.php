@extends('frontend._layout.main')

@section('content')
<div class="container">
    <div class="row">
        <div id="page-content" class="page-wrapper">
            <div class="zm-section single-post-wrap bg-white ptb-20 xs-pt-30">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            {!!$calendar->calendar()!!}
                        </div>

                        <div class="col-md-4">
                            <div class="row mb-40">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="section-title">
                                        <h2 class="h6 header-color inline-block uppercase">Upcoming Events</h2>
                                    </div>
                                </div>
                            </div>
                            <ul class="event-list">
                                @foreach($up_coming_events as $index => $info)
                                <li>
                                    <time datetime="2014-07-20">
                                        <span class="day">{{Helper::date_format($info->start,'d')}}</span>
                                        <span class="month">{{Helper::date_format($info->start,'M')}}</span>
                                        <span class="year">{{Helper::date_format($info->start,'Y')}}</span>
                                        {{-- <span class="time">ALL DAY</span> --}}
                                    </time>
                                    <img alt="Sample Event Title" src="https://farm4.staticflickr.com/3100/2693171833_3545fb852c_q.jpg" />
                                    <div class="info">
                                        <h2 class="title pb-20">{{Str::limit($info->title,$limit = 50)}}</h2>
                                        <button class="submit-button" type="submit" onclick="window.location.href='<?php echo route('frontend.events.show',$info->id.'-'.Str::slug($info->title)); ?>'">View Event</button>
                                    </div>
                                </li>
                                @endforeach
                                {{-- <li>
                                    <time datetime="2014-07-20">
                                        <span class="day">20</span>
                                        <span class="month">Jul</span>
                                        <span class="year">2014</span>
                                        <span class="time">ALL DAY</span>
                                    </time>
                                    <img alt="Independence Day" src="https://farm4.staticflickr.com/3100/2693171833_3545fb852c_q.jpg" />
                                    <div class="info">
                                        <h2 class="title pb-20">Sample Event Title</h2>
                                        <button class="submit-button" type="submit" onclick="window.location.href='event-detail.php'">View Event</button>
                                    </div>
                                </li>

                                <li>
                                    <time datetime="2014-07-20">
                                        <span class="day">5</span>
                                        <span class="month">Jul</span>
                                        <span class="year">2014</span>
                                        <span class="time">ALL DAY</span>
                                    </time>
                                    <img alt="Sample Event Title" src="https://farm4.staticflickr.com/3100/2693171833_3545fb852c_q.jpg" />
                                    <div class="info">
                                        <h2 class="title pb-20">Sample Event Title</h2>
                                        <button class="submit-button" type="submit" onclick="window.location.href='event-detail.php'">View Event</button>
                                    </div>
                                </li>

                                <li>
                                    <time datetime="2014-07-20">
                                        <span class="day">5</span>
                                        <span class="month">Sept</span>
                                        <span class="year">2014</span>
                                        <span class="time">ALL DAY</span>
                                    </time>
                                    <img alt="Sample Event Title" src="https://farm4.staticflickr.com/3100/2693171833_3545fb852c_q.jpg" />
                                    <div class="info">
                                        <h2 class="title pb-20">Sample Event Title</h2>
                                        <button class="submit-button" type="submit" onclick="window.location.href='event-detail.php'">View Event</button>
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop



@section('page-scripts')
<link href='{{asset('frontend/fullcalendar/fullcalendar.min.css')}}' rel='stylesheet' />
<script src='{{asset('frontend/fullcalendar/moment.min.js')}}'></script>
{{-- <link href='{{asset('frontend/fullcalendar/fullcalendar.print.min.css')}}' rel='stylesheet' media='print' /> --}}
<script src='{{asset('frontend/fullcalendar/fullcalendar.min.js')}}'></script>
<?php echo $calendar->script();?>
@stop