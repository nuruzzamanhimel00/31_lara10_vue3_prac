@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Real Chat</div>

                <div class="card-body">


                   <div class="row justify-content-center">
                    <div class="col-md-12">
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
                                        Title: FULL Calender LIST (VUEJS)  <br>
                                        <b>Youtube:</b> https://www.youtube.com/watch?v=x_WMkIKztRQ <br>

                                    </td>
                                    <td>
                                        Vue / Laravel
                                    </td>
                                    <td>
                                        <a href="{{route('fullcalender.index')}}" class="btn btn-primary">Visite</a>
                                    </td>
                                  </tr>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        Title: FULL Calender   <br>
                                        <b>Full calendr url:</b> https://fullcalendar.io/docs/getting-started <br>

                                    </td>
                                    <td>
                                         Laravel
                                    </td>
                                    <td>
                                        <a href="{{route('full.calender.index')}}" class="btn btn-primary">Visite</a>
                                    </td>
                                  </tr>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        Title: FULL Calender   <br>
                                        <b>Full calendr url:</b><br>

                                    </td>
                                    <td>
                                        Vue / Laravel
                                    </td>
                                    <td>
                                        <a href="{{route('full.calender.laravel')}}" class="btn btn-primary">Visite</a>
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
    </div>
</div>
@endsection
