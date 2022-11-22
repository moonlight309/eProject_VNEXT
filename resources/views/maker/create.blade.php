@extends('layout.master')
@section('content')
<div style="display: flex; justify-content: space-between">
    <a class="btn btn-primary" href="/">Back</a>
    <div>
        <a class="btn btn-primary" href="/">Clear</a>
    </div>
</div>
<br>
<form class="needs-validation" action="{{ route('makers.store') }}" method="post" enctype="multipart/form-data" >
@csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group mb-3">
        <label for="validationCustom01">Code</label>
        <input type="text" class="form-control" id="validationCustom01"
               placeholder="Code" name="code" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="validationCustom02">Name</label>
        <input type="text" class="form-control" id="validationCustom02"
               placeholder="Name" name="name" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="validationCustom02">Address</label>
        <input type="text" class="form-control" id="validationCustom02"
               placeholder="Address" name="address" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="validationCustom03">Phone</label>
        <input type="text" class="form-control" id="validationCustom03"
               placeholder="Phone" name="phone" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="validationCustom04">Description</label>
        <input type="text" class="form-control" id="validationCustom04"
               placeholder="Description" name="description" required>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="validationCustom05">Logo</label>
        <input type="file" class="form-control" id="validationCustom05"
               placeholder="Logo" name="logo" required>
        <div class="invalid-feedback">
            Please provide a valid zip.
        </div>
    </div>
    <button class="btn btn-primary" >Save</button>
{{--    <button class="btn btn-primary" type="submit">Them moi</button>--}}
</form>

@endsection
