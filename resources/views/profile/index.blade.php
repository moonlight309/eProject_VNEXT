@extends('layout.master')
@section('content')
    <div class="form-group text-right">
        <a href="{{ route('profile.edit') }}">
            <button type="button" class="btn btn-primary">
                <i class="mdi mdi-account-edit mr-1"></i> Edit Profile
            </button>
        </a>
        <a href="{{ route('password.change') }}">
            <button type="button" class="btn btn-danger">
                <i class="mdi mdi-key mr-1"></i> Change Password
            </button>
        </a>
    </div>
    <div class="card">
        <div class="card-body profile-user-box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="media">
                        <span class="float-left m-2 mr-4"><img
                                    src="{{ asset('storage/avatars/' . (auth()->user()->avatar ?? 'default-image.jpg')) }}"
                                    style="height: 100px;" alt="" class="rounded-circle img-thumbnail"></span>
                        <div class="media-body">
                            <h4 class="my-1">Name: {{ auth()->user()->name }}</h4>
                            <h4 class="my-2">Email: {{ auth()->user()->email }}</h4>
                            <h4 class="my-2">Phone: {{ auth()->user()->phone }}</h4>
                            <h4 class="my-2">Birthday: {{ \Carbon\Carbon::parse(auth()->user()->birthday)->format('Y-m-d') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection