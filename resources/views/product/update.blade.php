@extends('layout.master')
@section('content')
    @if (session('sucess'))
        <div class="alert alert-success">
            {{ session('sucess') }}
        </div>
    @endif
    <form action="{{ route('product.edit', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <table class="table table-bordered table-centered mb-0">
            <thead>
                <tr>
                    <th>User</th>
                    <th style="width: 100px"><input type="submit" value="Process" class="btn btn-primary"></th>
                    <th style="width: 100px" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3">
                        {{-- @foreach ($image as $rows)
                            <p>{{ $rows }}</p>
                            @if (file_exists('images/products/' . $rows) && $rows != '')
                                <img src="{{ asset('images/products/' . $rows) }}" style="height: 70px;">
                            @endif
                        @endforeach --}}
                        <div class="form-group">
                            <label for="simpleinput">Code</label>
                            <input type="text" name="code" id="code"
                                value="{{ isset($product->code) ? $product->code : '' }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="simpleinput">Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ isset($product->name) ? $product->name : '' }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="simpleinput">Image</label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                        </div>
                        <div class="form-group">
                            <label for="simpleinput">Price</label>
                            <input type="text" name="price" id="price"
                                value="{{ isset($product->price) ? $product->price : '' }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="color" name="color[]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="simpleinput">Description</label>
                            <input type="text" name="description" id="description"
                                value="{{ isset($product->description) ? $product->description : '' }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="maker_id">Maker_id</label>
                            <select name="maker_id" id="maker_id">
                                @foreach ($maker as $rows)
                                    <option {{ $product->maker_id == $rows->id ? 'selected' : '' }}
                                        value="{{ $rows->id }}">{{ $rows->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row" style="margin-top:10px; margin-bottom: 10px">
                            <div class="col-md-2">Category</div>
                            <div class="col-md-10">
                                <select name="category_id">
                                    @foreach ($category as $rows)
                                        @if ($rows->parent_id == 0)
                                            <option {{ $categoryProduct->category_id == $rows->id ? 'selected' : '' }}
                                                value="{{ $rows->id }}">{{ $rows->name }}</option>
                                            @foreach ($category as $rowsSub)
                                                @if ($rowsSub->parent_id != 0 && $rowsSub->parent_id == $rows->id)
                                                    <option
                                                        {{ $categoryProduct->category_id == $rowsSub->id ? 'selected' : '' }}
                                                        value="{{ $rowsSub->id }}">{{ '--' . $rowsSub->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
@endsection
