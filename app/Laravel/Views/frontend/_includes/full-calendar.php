<link href='fullcalendar/fullcalendar.min.css' rel='stylesheet' />
    <script src='fullcalendar/moment.min.js'></script>

    <link href='fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='fullcalendar/fullcalendar.min.js'></script>
    <script type="text/javascript">
        $(function(){
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultDate: '2017-09-01',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    {
                        title: 'Sample Event',
                        start: '2017-09-01'
                    },
                    {
                        title: 'Samle Title of a Long Event (Lorem Ipsum)',
                        start: '2017-09-07',
                        end: '2016-12-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2016-12-09T16:00:00'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2016-12-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2016-12-11',
                        end: '2016-12-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2016-12-12T10:30:00',
                        end: '2016-12-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2016-12-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2016-12-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2016-12-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2016-12-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2016-12-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2016-12-28'
                    }
                ]
            });
        });
    </script> 