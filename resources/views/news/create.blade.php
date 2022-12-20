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
    <div class="card">
        <div class="card-body">
            <form action="" data-url="{{ route('news.store') }}" id="form-add" method="POST">
                @csrf
                <div class="form-group text-right">
                    <a href="{{ route('news.index') }}" class="btn btn-primary" style="float: left">Back</a>
                    <button type="button" id="button-insert" class="btn btn-primary">Save</button>
                    <button type="reset" id="reset" class="btn btn-danger">Clear</button>
                </div>
                <div class="form-group">
                    <label for="simpleinput">Title</label>
                    <span class="important">*</span>
                    <input type="text" name="title" id="title-add" class="form-control">
                </div>

                <div class="form-group">
                    <label for="simpleinput">Content</label>
                    <span class="important">*</span>
                    <textarea id="ckeditor_content" name="content"></textarea>
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
            $('#button-insert').click(function () {
                let title = $('#title-add').val().trim();
                let content = CKEDITOR.instances.ckeditor_content.getData();
                console.log(content);
                $.ajax({
                    type: 'post',
                    url: "{{ route('news.store') }}",
                    data: {
                        title: title,
                        content: content,
                    },
                    success: function () {
                        $.toast({
                            heading: 'Success',
                            text: 'Create news successfully',
                            position: 'top-right',
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        setTimeout(function () {
                            window.location.href = "{{ route('news.index') }}";
                        }, 1000);

                    },
                    error: function () {
                        if(title == ''){
                            $.toast({
                                heading: 'Error',
                                text: 'Title is requied',
                                position: 'top-right',
                                showHideTransition: 'slide',
                                icon: 'error'
                            })
                        }if(content == '') {
                            $.toast({
                                heading: 'Error',
                                text: 'Content is requied',
                                position: 'top-right',
                                showHideTransition: 'slide',
                                icon: 'error'
                            })
                        }
                    }
                })
            })
        })
        $('#reset').click("click", function (e) {
            CKEDITOR.instances.ckeditor_content.setData('');
        });
    </script>
@endpush