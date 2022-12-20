@extends('layout.master')
@section('content')

    <form class="needs-validation" action="{{ route('makers.update' , $editMaker->id) }}" method="post" enctype="multipart/form-data" >
        @csrf
        <div style="display: flex; justify-content: space-between">
            <a class="btn btn-primary" href="{{ URL::to('makers/detail/' . $editMaker->id) }}">Back</a>
            <div>
                <button class="btn btn-primary" >Save</button>
                <button class="btn btn-primary" type="reset">Clear</button>
            </div>
        </div>
        <br>
        <div class="mt-4">
            <h6 class="font-14">last updated by: {{ $user->name ?? '' }}</h6>
        </div>
        <div class="form-group mb-3">
            <label for="validationCustom01">Code</label>
            <input type="text" class="form-control" id="validationCustom01"
                   placeholder="Code" name="code" value="{{ $editMaker->code }}" >
            @error('code')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="validationCustom02">Name</label>
            <input type="text" class="form-control" id="validationCustom02"
                   placeholder="Name" name="name" value="{{ $editMaker->name }}" >
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="validationCustom02">Address</label>
            <input type="text" class="form-control" id="validationCustom02"
                   placeholder="Address" name="address" value="{{ $editMaker->address }}" >
            @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="validationCustom03">Phone</label>
            <input type="text" class="form-control" id="validationCustom03"
                   placeholder="Phone" name="phone" value="{{ $editMaker->phone }}" >
            @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="validationCustom04">Description</label>
            <input type="text" class="form-control" id="validationCustom04"
                   placeholder="Description" name="description" value="{{ $editMaker->description }}" >
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="validationCustom05">Logo</label>
            <br>
            <img src="/images/maker/{{ isset($editMaker->logo) ? $editMaker->logo : 'default-image.jpg' }}" alt="" style="max-width: 280px">
            <br>
            <br>
            <input type="file" class="form-control" id="validationCustom05"
                   placeholder="Logo" name="logo" >
            @error('logo')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </form>

@endsection
