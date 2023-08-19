@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Full Calender Laravel</div>

                <div class="card-body">


                   <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div id='calendar'></div>

                    </div>
                   </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="booking_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Booking Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <small class="error_msg text-danger"></small>
                      </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_booking">Save Booking</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script src="{{asset('plugins/fullCalender/index.global.min.js')}}"></script>
       <script>


            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var events = @json($events);
                console.log(events);
                document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridYear,dayGridMonth,timeGridWeek,timeGridDay'
                        // right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    selectable: true,
                    selectMirror: true,
                    editable: true, // drag-n-drop and resize events. Start by setting the editable setting to true
                    events:events,
                    droppable:true,
                    eventDrop: function(info) {

                        let start_date = moment(info.event.start).format('YYYY-MM-DD HH:mm:ss');
                        let end_date = moment(info.event.end).format('YYYY-MM-DD HH:mm:ss');
                        let id = info.event.id;
                        // console.log(event.event.id)
                        $.ajax({
                            method:'put',
                            url:"{{ url('/full-calender-booking') }}/"+id,
                            data:{start_date:start_date, end_date:end_date},
                            success:function(response){
                                if($.trim(response) != ''){
                                if(response.status == 'success'){
                                    // calendar.addEvent({
                                    //     title: title,
                                    //     start: info.start,
                                    //     end: info.end,
                                    //     allDay: info.allDay
                                    // })
                                    calendar.unselect()
                                    // $('#booking_modal').modal('hide');
                                }
                                }
                            },
                            error: function (request, status, error) {
                                $(".error_msg").html(request.responseJSON.message);
                                console.log(request, request.responseJSON.message, error);
                            }
                        });
                    console.log('eventDrop', info);
                    },
                    select: function(info) {
                        $(".error_msg").html('');
                        $('#booking_modal').modal('toggle');

                        $("#save_booking").on('click', function(e) {
                            console.log('click hre');
                            let title = $('#title').val();
                            let start_date = moment(info.start).format('YYYY-MM-DD HH:mm:ss');
                            let end_date = moment(info.end).format('YYYY-MM-DD HH:mm:ss');

                            $.ajax({
                                type:'POST',
                                url:"{{ route('full.calender.booking.store') }}",
                                data:{title:title, start_date:start_date, end_date:end_date},
                                success:function(response){
                                  if($.trim(response) != ''){
                                    if(response.status == 'success'){
                                        calendar.addEvent({
                                            id:response.data.id,
                                            title: title,
                                            start: info.start,
                                            end: info.end,
                                            allDay: info.allDay
                                        })
                                        calendar.unselect()
                                        $('#booking_modal').modal('hide');
                                    }
                                  }

                                  console.log('response',response);
                                },
                                error: function (request, status, error) {
                                    $(".error_msg").html(request.responseJSON.message);
                                    console.log(request, request.responseJSON.message, error);
                                }
                            });


                        })

                        console.log('select',info);
                    },
                    eventClick: function(arg) {

                        if (confirm('Are you sure you want to delete this event?')) {
                            let id = arg.event.id;
                            // console.log(event.event.id)
                            $.ajax({
                                method:'delete',
                                url:"{{ url('/full-calender-booking') }}/"+id,
                                // data:{start_date:start_date, end_date:end_date},
                                success:function(response){
                                    if($.trim(response) != ''){
                                        if(response.status == 'success'){
                                            arg.event.remove()
                                            calendar.unselect()

                                        }
                                    }
                                },
                                error: function (request, status, error) {
                                    $(".error_msg").html(request.responseJSON.message);
                                    console.log(request, request.responseJSON.message, error);
                                }
                            });

                        }
                        console.log(arg);
                    },
                });
                calendar.render();
            });

            $(document).ready(function(){
                $('#booking_modal').on('hidden.bs.modal', function (event) {
                    $('#save_booking').unbind();
                    console.log('hidden');
                })
            })

            // $('#booking_modal').on('hidden.bs.modal', function () {
            //     $('#save_booking').unbind();
            // })
            // $("#booking_modal").on('hide.bs.modal', function(){
            //     // $('#save_booking').unbind();
            //     alert('The modal is about to be hidden.');
            // });

    </script>
@endpush
