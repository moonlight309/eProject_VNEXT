@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title">
                    <h2>Detail Category</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="p-1 flex-grow-1">
                            <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
                        </div>
                        <div class="p-1" >
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary" >Edit Category</a>
                        </div>
                        <div class="p-1">
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <input class="btn btn-danger" type="submit" onclick="return window.confirm('Are you sure?');"
                                       value="Delete" />
                            </form>
                        </div>
                    </div>
                    <br>
                    <p>
                        <b>Code:</b> {{ $category->code }}
                    </p>
                    <p>
                        <b>Name: </b> {{ $category->name }}
                    </p>
                    <p>
                        <b>Parent Id: </b>  {{ $category->parent_id }}
                    </p>
                    <p>
                        <b>Created_at: </b>  {{ $category->created_at }}
                    </p>
                    <p>
                        <b>Updated_at: </b>  {{ $category->updated_at }}
                    </p>
                    <p>
                        <b>created_user: </b>  {{ $category->created_user }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
