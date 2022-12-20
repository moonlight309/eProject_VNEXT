@extends('layout.master')
@section('content')
    <style>
        input[type="file"] {
            display: block;
        }

        .imageThumb {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }
    </style>
    @if (session('sucess'))
        <div class="alert alert-success">
            {{ session('sucess') }}
        </div>
    @endif
    @if (session('unique'))
        <div class="alert alert-danger">
            {{ session('unique') }}
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <table class="table table-bordered table-centered mb-0">
            <thead>
                <tr>
                    <th><a href="#" onclick="history.go(-1);" class="btn btn-primary">Back</a></th>
                    <th style="width: 100px"><input type="submit" value="Save" class="btn btn-primary"></th>
                    <th style="width: 100px" class="text-center"><input type="reset" value="Clear"
                            class="btn btn-danger">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3">
                        <div class="form-group">
                            <label for="simpleinput">Code</label>
                            <input type="text" name="code" id="code"
                                value="{{ isset($product->code) ? $product->code : '' }}" class="form-control">
                        </div>
                        @error('code')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="simpleinput">Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ isset($product->name) ? $product->name : '' }}" class="form-control">
                        </div>
                        @error('name')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="simpleinput">Image</label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                        </div>
                        <div class='btn btn-primary' id='remove' style="display: none">
                            Clear
                        </div>
                        @error('image')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        @error('image.*')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror

                        <input type="hidden" name="photo" id="photo" value="">
                        <img src="{{ asset('images/products/default/meme-meo-like-trong-dau-kho.jpg') }}"
                            class="img-fluid img-thumbnail p-2" id="def" style="max-width: 75px; display:none"
                            alt="Product-img" />
                        <div id="check">
                            @if ($product->image != '' || $product->image != [])
                                @foreach ($product->image as $rows)
                                    <a href="javascript: void(0);">
                                        <img src="{{ asset('storage/products/' . $rows) }}"
                                            class="img-fluid img-thumbnail p-2" style="max-width: 75px;"
                                            alt="Product-img" />

                                    </a>
                                @endforeach
                            @endif
                        </div>
                        @if ($product->image != '' || $product->image != [])
                            <div class="btn btn-primary" id="test">clear</div>
                        @endif
                        <div class="form-group">
                            <label for="simpleinput">Price</label>
                            <input type="text" name="price" id="price"
                                value="{{ isset($product->price) ? $product->price : '' }}" class="form-control">
                        </div>
                        @error('price')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="color">Color</label>
                            <select class="form-control color" name="color[]" multiple="multiple">
                                @if (isset($product->color))
                                    @foreach ($product->color as $data)
                                        <option {{ $data == '#DB2828' ? 'selected' : '' }} value="#DB2828">Red</option>
                                        <option {{ $data == '#FBBD08' ? 'selected' : '' }} value="#FBBD08">Yellow
                                        </option>
                                        <option {{ $data == '#21BA45' ? 'selected' : '' }} value="#21BA45">Green</option>
                                        <option {{ $data == '#2185D0' ? 'selected' : '' }} value="#2185D0">Blue</option>
                                        <option {{ $data == '#6435C9' ? 'selected' : '' }} value="#6435C9">Violet
                                        </option>
                                        <option {{ $data == '#E03997' ? 'selected' : '' }} value="#E03997">Pink</option>
                                    @endforeach
                                @else
                                    <option value="#DB2828">Red</option>
                                    <option value="#FBBD08">Yellow</option>
                                    <option value="#21BA45">Green</option>
                                    <option value="#2185D0">Blue</option>
                                    <option value="#6435C9">Violet</option>
                                    <option value="#E03997">Pink</option>
                                @endif
                            </select>
                        </div>
                        @error('color')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description">{{ isset($product->description) ? $product->description : '' }}</textarea>
                            <script>
                                CKEDITOR.replace('description');
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="maker_id">Maker_id</label>
                            <select class="custom-select mb-3" name="maker_id" id="maker_id">
                                @foreach ($maker as $rows)
                                    <option {{ $product->maker_id == $rows->id ? 'selected' : '' }}
                                        value="{{ $rows->id }}">{{ $rows->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('maker_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control category_id" name="category_id[]" multiple="multiple">
                                @foreach ($category as $rows)
                                    @if ($count == 0)
                                        @if ($rows->parent_id == 0)
                                            <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                            @foreach ($category as $rowsSub)
                                                @if ($rowsSub->parent_id != 0 && $rowsSub->parent_id == $rows->id)
                                                    <option value="{{ $rowsSub->id }}">{{ '--' . $rowsSub->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        @if ($rows->parent_id == 0)
                                            @foreach ($categoryProduct as $data)
                                                <option
                                                    {{ $data->category_id == $rows->id && $data->product_id == $product->id ? 'selected' : '' }}
                                                    value="{{ $rows->id }}">{{ $rows->name }}</option>
                                                @foreach ($category as $rowsSub)
                                                    @if ($rowsSub->parent_id != 0 && $rowsSub->parent_id == $rows->id)
                                                        <option
                                                            {{ $data->category_id == $rowsSub->id && $data->product_id == $product->id ? 'selected' : '' }}
                                                            value="{{ $rowsSub->id }}">{{ '--' . $rowsSub->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#image").on("change", function(e) {
                    $(".pip").remove();
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            var file = e.target;
                            $("<span class=\"pip\">" +
                                "<img class=\"imageThumb\" src=\"" + e.target.result +
                                "\" title=\"" + file.name + "\"/>" +
                                "</span>").insertAfter("#image");
                        });
                        fileReader.readAsDataURL(f);
                        document.getElementById("check").style.display = 'none';
                        document.getElementById("def").style.display = 'none';
                        document.getElementById("test").style.display = 'none';
                        document.getElementById("photo").value = '';
                    }
                    document.getElementById('remove').style.display = 'inherit';
                    $("#remove").click(function() {
                        $(".pip").remove();
                        document.getElementById('image').value = "";
                        $("#remove").hide();
                        document.getElementById("photo").value = 'meme-meo-like-trong-dau-kho.jpg';
                        document.getElementById("def").style.display = 'block';
                    });
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
    </script>

    <script>
        $(".color ").select2({
            tags: false
        });
        $(".category_id ").select2({
            tags: false
        });

        document.getElementById("test").addEventListener("click", function() {
            document.getElementById("photo").value = 'meme-meo-like-trong-dau-kho.jpg';
            document.getElementById("check").style.display = 'none';
            document.getElementById("def").style.display = 'block';
            document.getElementById("test").style.display = 'none';
            //document.getElementById("image").value = 'meme-meo-like-trong-dau-kho.jpg';
        });
    </script>
@endsection
