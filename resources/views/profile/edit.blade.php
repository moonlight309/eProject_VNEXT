{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Profile') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">--}}
{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.update-profile-information-form')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.update-password-form')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.delete-user-form')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}

@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group text-right">
                    <a href="{{ route('profile.index') }}" class="btn btn-primary" style="float: left">Back</a>
                    <button class="btn btn-primary">
                        Save
                    </button>
                    <button type="reset" class="btn btn-danger">
                        Clear
                    </button>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
                </div>
                <div class="form-group">
                    <label>Birthday</label>
                    <input type="date" name="birthday" class="form-control"
                           value="{{ old('birthday', \Carbon\Carbon::parse(auth()->user()->birthday)->format('Y-m-d')) }}">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}">
                </div>
            </form>
        </div>
    </div>
@endsection
