@extends('layout.master')
@section('content')
    <div style="width: 100%; display: flex; justify-content: space-between">
        <div>
            <form method="GET">
                <div class="input-group">
                    <input value="{{ $search }}" name="search"  type="serch" class="form-control" placeholder="Search..." id="top-search" >
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4" style="text-align: right">
            <a href="javascript:void(0);" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add User</a>
        </div>
    </div>
    <table class="table table-striped table-centered mb-0">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Avatar</th>
            <th>Birthday</th>
            <th>Phone</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $data)
            <tr>
                <td><a href="">{{$data->name}}</a></td>
                <td>{{$data->email}}</td>
                <td><img src="{{$data->avatar}}" alt="" style="width: 150px; height: 150px"> </td>
                <td>{{$data->birthday}}</td>
                <td >{{$data->phone}}</td>
            </tr>
        @endforeach

        </tbody>
        {{--    {{ $data->links() }}--}}

    </table>
    {{ $users->links() }}
@endsection
