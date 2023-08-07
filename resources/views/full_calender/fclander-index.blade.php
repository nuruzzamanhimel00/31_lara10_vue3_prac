@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Full Calender</div>

                <div class="card-body">


                   <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div id='calendar'></div>
                    </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')

@endpush
@push('script')
    <script src="{{asset('plugins/fullCalender/index.global.min.js')}}"></script>
       <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridYear,dayGridMonth,timeGridWeek'
        },
          initialView: 'dayGridMonth',
          initialDate: '2023-08-07',
          selectable: true,
          selectMirror: true,
          editable: true, // drag-n-drop and resize events. Start by setting the editable setting to true
        //   droppable:true,
          select: function(info) {
                console.log('select',info);
            },
            drop: function(info) {
              console.log('drop', info);
            },
            events: [
            {
            title: 'All Day Event',
            start: '2023-08-08'
            },
            {
            title: 'Long Event',
            start: '2023-08-07',
            end: '2023-08-10'
            },
            {
            groupId: 999,
            title: 'Repeating Event',
            start: '2023-08-09T16:00:00'
            },
            {
            groupId: 999,
            title: 'Repeating Event',
            start: '2023-08-16T16:00:00'
            },
            {
            title: 'Conference',
            start: '2023-08-11',
            end: '2023-08-13'
            },
            {
            title: 'Meeting',
            start: '2023-08-12T10:30:00',
            end: '2023-08-12T12:30:00'
            },
            {
            title: 'Lunch',
            start: '2023-08-12T12:00:00'
            },
            {
            title: 'Meeting',
            start: '2023-08-12T14:30:00'
            },
            {
            title: 'Happy Hour',
            start: '2023-08-12T17:30:00'
            },
            {
            title: 'Dinner',
            start: '2023-08-12T20:00:00'
            },
            {
            title: 'Birthday Party',
            start: '2023-08-13T07:00:00'
            },
            {
            title: 'Click for Google',
            url: 'http://google.com/',
            start: '2023-08-28'
            }
        ]


        });
        calendar.render();

        calendar.on('dateClick', function(info) {
            console.log('clicked on ' + info.dateStr, info);
            });
      });

    </script>
@endpush
