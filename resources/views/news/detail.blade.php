@extends('layout.master')
@section('content')

    <div class="col-sm-12" style="text-align: right">
        <a style="border-radius: 10px" href="{{ URL::to('news/edit/'. $news->id) }}" class="btn btn-primary mb-2">Edit News</a>
    </div>
    <div class="card">
        <div class="card-body">
            <h1>{{ $news->title }}</h1>
            <p>By: <i>{{ $user->name ?? 'None' }}</i></p>
            <p>Time: {{ $news->created_at }}</p>
            <p>{!! $news->content !!}</p>
        </div>
    </div>

@endsection