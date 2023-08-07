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
                                        Title: dropzone  <br>
                                        <b>Youtube:</b> https://www.youtube.com/watch?v=x_WMkIKztRQ <br>

                                    </td>
                                    <td>
                                        Vue / Laravel
                                    </td>
                                    <td>
                                        <a href="{{route('dropzone.index')}}" class="btn btn-primary">Visite</a>
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
