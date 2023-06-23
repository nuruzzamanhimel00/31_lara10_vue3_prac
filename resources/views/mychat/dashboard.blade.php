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
                                <div class="col-md-12 text-center">
                                    <h2>Dashboard</h2>
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
