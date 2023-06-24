@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card h-100">
                <div class="card-header">Real Chat</div>

                <div class="card-body p-0">


                   <div class="row justify-content-center">
                    <div class="col-md-12">
                        @include('mychat.partials.navbar')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="card h-100 w-100">
                                        <div class="card-header">
                                            Group Name: {{$group->name}}
                                        </div>
                                        <div class="card-body p-0">
                                            <group-chat-component > </group-chat-component>
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
@push('script')

@endpush
@push('style')

@endpush

