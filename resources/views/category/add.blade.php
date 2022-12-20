@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title">
                    <h2>Add Category</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-pane show active" id="form-row-preview">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    Please double check the data
                                </div>
                            @endif
                            <div class="d-flex">
                                <div class="p-1 flex-grow-1">
                                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
                                </div>
                                <div class="p-1" >
                                    <input type="submit" class="btn btn-success" name="add" value="Add Category">
                                </div>
                                <div class="p-1">
                                    <input type="reset" name="reset" class="btn btn-light" value="Clear">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCode" class="col-form-label">Code Category <span style="color: red; font-weight: bold; font-size: 18px">*</span></label>
                                <input type="text" class="form-control" id="inputCode" placeholder="Code Category" name="code">
                                @error('code')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="inputCategory" class="col-form-label">Name Category <span style="color: red; font-weight: bold; font-size: 18px">*</span></label>
                                <input type="text" class="form-control" id="inputCategory" placeholder="Name Category" name="name">
                                @error('name')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <input type="hidden" id="inputParent" class="form-control" value="0" name="parent_id" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
