@extends('layout.master')
@section('content')
    <div class="form-group" style="display: flex; justify-content: space-between">
        <div>
            <a href="{{ route('users.index') }}" class="btn btn-primary">
                Back
            </a>
        </div>
        <div style="display: flex">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary" style="margin-right: 10px">
                Edit
            </a>
            <form action="{{ route('users.destroy',$user->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5">
                    <!-- Product image -->
                    <div class="text-center d-block mb-4">
                        <img src="{{ $user->avatar ?? asset('storage/avatars/default-image.jpg') }}" class="img-fluid" style="max-width: 400px;" alt="avatar">
                    </div>
                </div> <!-- end col -->
                <div class="col-lg-7">
                    <form class="pl-lg-4">
                        <h3 class="mt-0">Name: {{ $user->name }}</h3>
                        <h3 class="mt-4">Email: {{ $user->email }}</h3>
                        <h3 class="mt-4">Birthday: {{ Carbon\Carbon::parse($user->birthday)->format('Y-m-d') }}</h3>
                        <h3 class="mt-4">Age: {{ $user->age }}</h3>
                        <h3 class="mt-4">Phone: {{ $user->phone }}</h3>
                    </form>
                </div> <!-- end col -->
            </div> <!-- end row-->

            <!-- end table-responsive-->

        </div> <!-- end card-body-->
    </div>
@endsection