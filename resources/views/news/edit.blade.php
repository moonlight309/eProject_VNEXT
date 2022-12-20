@extends('layout.master')
@push('css')
    <link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .important {
            color: red;
        }
    </style>
@endpush
@section('content')
    <div class="col-sm-12" style="text-align: right">
        <form action="{{ route('news.destroy', $news->id) }}" method="POST"
              onclick="return confirm('Are you sure you want to delete this item?');">
            @csrf
            @method('DELETE')
            <button type="submit" style="border-radius: 10px" class="btn btn-danger mb-2">Delete News</button>
        </form>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group text-right">
                    <a href="{{ route('news.index') }}" class="btn btn-primary" style="float: left">Back</a>
                    <button type="button" id="button-update" class="btn btn-primary">Save</button>
                    <button type="reset" id="reset" class="btn btn-danger">Cancel</button>
                </div>

                <div class="form-group">
                    <label>Last Editor: {{ $user->name ?? ''}}</label>
                </div>

                <div class="form-group">
                    <label for="simpleinput">Title</label>
                    <span class="important">(*)</span>
                    <input type="text" name="title" id="title-edit" class="form-control" value="{{ $news->title }}">
                </div>

                <div class="form-group">
                    <label for="simpleinput">Content</label>
                    <span class="important">(*)</span>
                    <textarea id="ckeditor_content" name="content">{{ $news->content }}</textarea>
                </div>


            </form>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="//cdn.ckeditor.com/4.20.0/full/ckeditor.js"></script>
    <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/demo.summernote.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('ckeditor_content', {
            filebrowserImageUploadUrl: '{{ url('upload-ckeditor?_token='.csrf_token()) }}',
            filebrowerUploadMethod: 'form'
        });
        CKEDITOR.config.height = 700;
        entities: false

    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('#button-update').click(function () {
                let title = $('#title-edit').val().trim();
                let content = CKEDITOR.instances.ckeditor_content.getData();
                console.log(content);
                $.ajax({
                    type: 'put',
                    url: "{{ route('news.update', $news->id) }}",
                    data: {
                        title: title,
                        content: content,
                    },
                    success: function () {
                        $.toast({
                            heading: 'Success',
                            text: 'Update news successfully',
                            position: 'top-right',
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        setTimeout(function () {
                            window.location.href = "{{ route('news.detail', $news->id) }}";
                        }, 1000);
                    },
                    error: function () {
                        if (title == '') {
                            $.toast({
                                heading: 'Error',
                                text: 'Title is requied',
                                position: 'top-right',
                                showHideTransition: 'slide',
                                icon: 'error'
                            })
                            document.getElementById("title-edit").value = "{{ $news->title }}";
                        }
                        if (content == '') {
                            $.toast({
                                heading: 'Error',
                                text: 'Content is requied',
                                position: 'top-right',
                                showHideTransition: 'slide',
                                icon: 'error'
                            })
                            CKEDITOR.instances['ckeditor_content'].setData({{ old('content') }})
                        }
                    }
                });
            });
        });
        $('#reset').click("click", function (e) {
            CKEDITOR.instances['ckeditor_content'].setData({{ old('content') }}),
            $('#title-edit').val({{ old('title') }})
        });
    </script>
@endpush