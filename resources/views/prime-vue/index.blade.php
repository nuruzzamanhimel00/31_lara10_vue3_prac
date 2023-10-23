@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Real Chat</div>

                <div class="card-body">
                    <datatable-paginate />

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
