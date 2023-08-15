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
                                        <b>url:</b> https://www.codesolutionstuff.com/laravel-9-dropzone-image-upload-example-step-by-step?expand_article=1
                                        <a href="{{asset('assets/fileOrPdf/dropZone/dropZone image upload.pdf')}}">Download</a>
                                        <br>
                                        url weblessong (vvi): https://www.webslesson.info/2020/04/drag-and-drop-multiple-file-upload-in-laravel-7-using-dropzonejs.html
                                        <a href="{{asset('assets/fileOrPdf/dropZone/weblesson dropzone click upload.pdf')}}">Download</a>

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
