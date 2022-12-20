@extends('layout.master')
@section('content')


<form class="needs-validation" action="{{ route('makers.store') }}" method="post" enctype="multipart/form-data" >
@csrf
    <div style="display: flex; justify-content: space-between">
        <a class="btn btn-primary" href="{{ route('makers.index') }}">Back</a>
        <div>
            <button class="btn btn-primary" >Save</button>
            <button class="btn btn-primary" type="reset">Clear</button>
        </div>
    </div>
    <br>
    <div class="form-group mb-3">
        <label for="validationCustom01">Code <span style="color: red">(*)</span></label>
        <input type="text" class="form-control" id="validationCustom01"
               placeholder="Code" name="code" >
        @error('code')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>
    <div class="form-group mb-3">
        <label for="validationCustom02">Name <span style="color: red">(*)</span></label>
        <input type="text" class="form-control" id="validationCustom02"
               placeholder="Name" name="name" >
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>
    <div class="form-group mb-3">
        <label for="validationCustom02">Address <span style="color: red">(*)</span></label>
        <input type="text" class="form-control" id="validationCustom02"
               placeholder="Address" name="address" >
        @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>
    <div class="form-group mb-3">
        <label for="validationCustom03">Phone <span style="color: red">(*)</span></label>
        <input type="text" class="form-control" id="validationCustom03"
               placeholder="Phone" name="phone" >
        @error('phone')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>
    <div class="form-group mb-3">
        <label for="validationCustom04">Description</label>
        <input type="text" class="form-control" id="validationCustom04"
               placeholder="Description" name="description" >
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>
    <div class="form-group mb-3">
        <label for="validationCustom05">Logo</label>
        <input type="file" class="form-control" id="validationCustom05"
               placeholder="Logo" name="logo" >
        @error('logo')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

    </div>
{{--    <button class="btn btn-primary" type="submit">Them moi</button>--}}
</form>

@endsection

@push('js')
    <scipt>

    </scipt>
@endpush
