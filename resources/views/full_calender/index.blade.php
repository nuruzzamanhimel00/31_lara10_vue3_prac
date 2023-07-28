@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Full Calender</div>

                <div class="card-body">


                   <div class="row justify-content-center">
                    <div class="col-md-12">
                        <calender-component />
                    </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
