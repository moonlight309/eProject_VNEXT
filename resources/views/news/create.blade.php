@extends('layout.master')
@push('css')
    <link href="{{ asset('css/summernote-bs4.css') }}" rel="stylesheet" type="text/css"/>
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('news.store') }}" method="POST">
                @csrf
                <h1 style="text-align: center">Create News</h1>

                <div class="form-group">
                    <label for="simpleinput">Title</label>
                    <input type="text" name="title" id="simpleinput" class="form-control">
                </div>

                <div class="form-group">
                    <label for="simpleinput">Content</label>
                    <textarea id="ckeditor_content" name="content"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

@endsection
@push('js')
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
@endpush