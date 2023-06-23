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
                                            <table class="table" id="myTable">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Code</th>
                                                    <th scope="col">Created By</th>
                                                    <th scope="col">Action</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($groups as $group )
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $group->name }}</td>
                                                        <td>{{ $group->code }}</td>
                                                        <td>{{ $group->user->name }}</td>
                                                        <td>
                                                            @if($group->user->id === auth()->user()->id)
                                                            <a href="" class="btn btn-success ">Members({{$group->mychatUsers->count()}})</a>
                                                            @else
                                                            <a href="" class="btn btn-light ">Members({{$group->mychatUsers->count()}})</a>
                                                            @endif
                                                            {{-- {{dd($group->mychatUsers()->pluck('user_id')->toArray())}} --}}
                                                            @if(!in_array(auth()->user()->id,$group->mychatUsers()->pluck('user_id')->toArray()))
                                                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$group->id}}">Join Group</a>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal{{$group->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="{{route('mychat.make.group.join')}}" method="POST">
                                                                        @csrf
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>

                                                                    <div class="modal-body">

                                                                            <div class="form-group">
                                                                              <label for="code">Code</label>
                                                                              <input type="hidden" class="form-control" id="group_id" name="group_id" value="{{$group->id}}" >
                                                                              <input type="text" class="form-control" id="code" name="code" value="">
                                                                            </div>



                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">JOIN</button>
                                                                    </div>
                                                                </form>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <a href="" class="btn btn-primary">Chat Group</a>
                                                            @endif

                                                        </td>
                                                      </tr>

                                                    @endforeach

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
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
@endpush
@push('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endpush

