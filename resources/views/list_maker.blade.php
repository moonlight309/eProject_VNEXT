@extends('layout.master')
@section('content')
    <div style="width: 100%; display: flex; justify-content: space-between">
        <div>
            <form>
                <div class="input-group">
                    <input value="{{ $search }}" name="search" type="search" class="form-control" placeholder="Search..." id="top-search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4" style="text-align: right">
            <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Maker</a>
        </div>
    </div>

    <table class="table table-striped table-centered mb-0" id="table-data">
        <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Logo</th>
            <th>Address</th>
            <th>Description</th>
            <th>Phone</th>
        </tr>
        </thead>
        <tbody>
        @foreach($makers as $data)
            <tr>
                <td>{{$data->code}}</td>
                <td><a href="">{{$data->name}}</a></td>
                <td><img src="{{$data->logo}}" alt="" style="width: 150px; height: 150px"> </td>
                <td>{{$data->address}}</td>
                <td ><p style="width: 150px;
                    overflow: hidden;
                    white-space: nowrap;
                    text-overflow: ellipsis;">{{$data->description}}</p></td>

                <td>{{$data->phone}}</td>
            </tr>
        @endforeach

        </tbody>
        {{--    {{ $data->links() }}--}}

    </table>
    {{ $makers->links() }}

@endsection
