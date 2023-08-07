@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">#SL</th>
                                <th scope="col">Title/ Descriiption</th>
                                <th scope="col">Tecnology</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>
                                    Title: Biftums: Real Time Chat With Laravel Broadcast, Pusher and Vuejs  <br>
                                    url: https://www.youtube.com/watch?v=u6CwVxcyfD0&list=PLe30vg_FG4OQsCOAzymRY5GkQpFqc1U-D <br>
                                    View: <a href="{{ asset('assets/fileOrPdf/bitfums realtime chat in lara vue push.docx') }}"> Download Pdf </a>
                                </td>
                                <td>
                                    Vue / Laravel
                                </td>
                                <td>
                                    <a href="{{route('realtime.chat')}}" class="btn btn-primary">Visite</a>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">1</th>
                                <td>
                                    Title: FULL Calender LIST  <br>

                                </td>
                                <td>
                                    Vue / Laravel
                                </td>
                                <td>
                                    <a href="{{route('fullcalender.list')}}" class="btn btn-primary">Visite</a>
                                </td>
                              </tr>
                              <tr>
                                <th scope="row">1</th>
                                <td>
                                    Title: Dropzone.js  <br>

                                </td>
                                <td>
                                    Vue / Laravel
                                </td>
                                <td>
                                    <a href="{{route('dropzone.list')}}" class="btn btn-primary">Visite</a>
                                </td>
                              </tr>




                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
