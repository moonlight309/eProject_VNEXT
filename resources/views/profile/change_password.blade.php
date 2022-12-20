@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')
                <div class="form-group text-right">
                    <a href="{{ route('profile.index') }}" class="btn btn-primary" style="float: left">Back</a>
                    <button class="btn btn-primary">Save</button>
                </div>
                <div class="form-group">
                    <label>Current Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                               name="current_password">
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                    @error('current_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password">
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                               name="password_confirmation">
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                    @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </form>
        </div>
    </div>
@endsection