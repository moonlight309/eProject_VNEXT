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
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="ajax-form">
        @csrf
        <table class="table table-bordered table-centered mb-0">
            <thead>
                <tr>
                    <th><a href="#" onclick="history.go(-1);" class="btn btn-primary">Back</a></th>
                    <th style="width: 100px"><button class="btn btn-primary" id="btn-submit">Save</th>
                    <th style="width: 100px" class="text-center"><input type="reset" value="Clear"
                            class="btn btn-danger">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3">
                        <div class="form-group">
                            <label for="code">Code<span style="color: red">(*)</span></label>
                            <input type="text" name="code" id="code"
                                class="form-control @error('code') is-invalid @enderror">
                            <span class="text-danger error-text code_error"></span>
                        </div>
                        @error('code')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="name">Name<span style="color: red">(*)</span></label>
                            <input type="text" name="name" id="name" class="form-control">
                            <span class="text-danger error-text name_error"></span>
                        </div>
                        @error('name')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="image[]">Image</label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                            <span class="text-danger error-text image.*_error"></span>
                        </div>
                        @error('image')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        @error('image.*')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <div class='btn btn-primary' id='remove' style="display: none">
                            Clear
                        </div>
                        <div class="form-group">
                            <label for="price">Price<span style="color: red">(*)</span></label>
                            <input type="text" name="price" id="price" class="form-control">
                            <span class="text-danger error-text price_error"></span>
                        </div>
                        @error('price')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="color">Color<span style="color: red">(*)</span></label>
                            <select class="form-control color" name="color[]" id="color" multiple="multiple">
                                <option value="#DB2828">Red</option>
                                <option value="#FBBD08">Yellow</option>
                                <option value="#21BA45">Green</option>
                                <option value="#2185D0">Blue</option>
                                <option value="#6435C9">Violet</option>
                                <option value="#E03997">Pink</option>
                            </select>
                            <span class="text-danger error-text color_error"></span>
                        </div>
                        <script>
                            $(".color ").select2({
                                tags: false,
                            });
                        </script>
                        @error('color')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description"></textarea>
                            <script>
                                CKEDITOR.replace('description');
                            </script>
                        </div>

                        <div class="form-group">
                            <label for="maker_id">Maker_id<span style="color: red">(*)</span></label>
                            <select class="custom-select mb-3" name="maker_id" id="maker_id">
                                @foreach ($maker as $rows)
                                    <option value="{{ $rows->id }}">
                                        {{ $rows->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text maker_id_error"></span>
                        </div>
                        @error('maker_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="category_id">Category<span style="color: red">(*)</span></label>
                            <select class="form-control category_id" id="category_id" name="category_id[]"
                                multiple="multiple">
                                @foreach ($category as $rows)
                                    @if ($rows->parent_id == 0)
                                        <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                        @foreach ($category as $rowsSub)
                                            @if ($rowsSub->parent_id != 0 && $rowsSub->parent_id == $rows->id)
                                                <option value="{{ $rowsSub->id }}">{{ '--' . $rowsSub->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger error-text category_id_error"></span>
                        </div>
                        <script>
                            $(".category_id ").select2({
                                tags: false
                            });
                        </script>
                        @error('category_id')
                            <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
@endsection
@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#btn-submit').click(function(e) {
                e.preventDefault();

                let formData = new FormData($('#ajax-form')[0]);
                $.ajax({
                    type: "post",
                    url: "{{ route('products.store') }}",
                    data: formData,
                    processData: false,
                    cache: false,
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').html('');
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            alert(data.success);
                            setTimeout(function() {
                                window.location.href = "{{ route('products.index') }}";
                            }, 500);
                        } else {
                            console.log(data.error);
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').html(val[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#image").on("change", function(e) {
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
                    }
                    document.getElementById('remove').style.display = 'inherit';
                    $("#remove").click(function() {
                        $(".pip").remove();
                        document.getElementById('image').value = "";
                        $("#remove").hide();
                    });
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
        });
    </script>
@endpush
