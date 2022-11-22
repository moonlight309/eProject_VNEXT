@extends('layout.master')
@section('content')
    <div style="width: 100%; display: flex; justify-content: space-between">
        <div>
            <form method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search..." id="top-search" value="{{ $search }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4" style="text-align: right">
            <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Products</a>
        </div>
    </div>
<table class="table table-striped table-centered mb-0">
    <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Price</th>
            <th>Color</th>
        </tr>
    </thead>
    <tbody>
    @foreach($products as $data)
        <tr>
            <td>{{$data->code}}</td>
            <td><a href="">{{$data->name}}</a></td>
            <td><img src="{{$data->image}}" alt="" style="width: 150px; height: 150px"> </td>
            <td ><p style="width: 150px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;">{{$data->description}}</p></td>
            <td>{{$data->price}}</td>
            <td>{{$data->color}}</td>
        </tr>
    @endforeach

    </tbody>
{{--    {{ $data->links() }}--}}

</table>
{{ $products->links() }}
@endsection
