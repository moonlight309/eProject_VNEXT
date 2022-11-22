@extends('layout.master')
@section('content')
    <div style="width: 100%; display: flex; justify-content: space-between">
        <div>
            <form method="GET">
                <div class="input-group">
                    <input value="{{ $search }}" name="search" type="search" class="form-control"
                           placeholder="Search..." id="top-search">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-4" style="text-align: right">
            <a href="{{ route('news.create') }}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i>
                Add New</a>
        </div>
    </div>
    <table class="table table-striped table-centered mb-0">
        <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $data)
            <tr>
                <td><a href="">{{$data->title}}</a></td>
                <td><p style="width: 350px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;">{{$data->content}}</p></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $news->links() }}
@endsection
