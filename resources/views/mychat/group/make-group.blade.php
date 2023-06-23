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
                        @include('mychat.partials.navbar')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="card">
                                        <div class="card-header">
                                            Make Group
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('mychat.make.group.submit')}}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                  <label for="name">Name</label>
                                                  <input type="text" class="form-control" id="name" name="name" >

                                                </div>
                                                <div class="form-group">
                                                  <label for="code">Code</label>
                                                  <input type="text" class="form-control" id="code" name="code" value="{{random_digits()}}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                              </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
