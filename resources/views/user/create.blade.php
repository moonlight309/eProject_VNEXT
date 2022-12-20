@extends('layout.master')
@push('css')
    <style>
        .important {
            color: red;
        }
    </style>
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="email_verified_at">
                <div class="form-group text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-primary" style="float: left">Back</a>
                    <button class="btn btn-primary">Save</button>
                    <button class="btn btn-danger" type="reset">Clear</button>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <span class="important">*</span>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-control @error('name') invalid @enderror">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <span class="important">*</span>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Birthday</label>
                    <input type="date" name="birthday" value="{{ old('birthday') }}"
                        class="form-control @error('birthday') is-invalid @enderror">
                    @error('birthday')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <span class="important">*</span>
                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                        <option hidden>Choose role</option>
                        @foreach ($roles as $role => $value)
                            <option value="{{ $value }}" @if (old('role') === $value) selected @endif>
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Avatar</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="avatar"
                                class="custom-file-input @error('avatar') is-invalid @enderror" id="input-avatar">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                    @error('avatar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <img src="{{ asset('storage/avatars/default-image.jpg') }}" class="img-fluid avatar-lg rounded-circle"
                        id="preview-avatar">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <span class="important">*</span>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <span class="important">*</span>
                    <div class="input-group input-group-merge">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation">
                        <div class="input-group-append" data-password="false">
                            <div class="input-group-text">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#input-avatar').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
        $('#input-avatar').on('change', function() {
            if ($(this).val() === '') {
                $('#preview-avatar').attr('src', '{{ asset('storage/avatars/default-image.jpg') }}');
            }
        });
    </script>
@endpush
