@extends('layout.master')
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="col-sm-12" style="text-align: right">
                <a style="border-radius: 10px" href="{{ route('news.create') }}" class="btn btn-primary mb-2">Edit News</a>
            </div>

            <h1>{{ $news->title }}</h1>
            <p>By: <i>{{ $news->user->name }}</i></p>
            <p>Time: {{ $news->created_at }}</p>
            <p>{!! $news->content !!}</p>

        </div>
    </div>

@endsection