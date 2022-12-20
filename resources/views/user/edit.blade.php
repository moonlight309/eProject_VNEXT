@extends('layout.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group text-right">
                    <a href="{{ route('users.detail', $user->id) }}" class="btn btn-primary" style="float: left">Back</a>
                    <button class="btn btn-primary">Save</button>
                    <button class="btn btn-danger" type="reset">Clear</button>
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Birthday</label>
                    <input type="date" name="birthday" value="{{ Carbon\Carbon::parse($user->birthday)->format('Y-m-d') }}" class="form-control @error('birthday') is-invalid @enderror">
                    @error('birthday')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                        <option hidden>Choose role</option>
                        @foreach($roles as $key => $value)
                            <option
                                    value="{{ $value }}"
                                    @if(old('role') === $value)
                                        selected
                                    @endif
                                    @if($user->role === $value)
                                        selected
                                    @endif
                            >
                                {{ $key }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ $user->phone }}" class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Avatar</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="avatar" value="{{ $user->avatar }}" class="custom-file-input @error('avatar') is-invalid @enderror" id="input-avatar">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                    @error('avatar')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <img src="{{ $user->avatar ?? asset('storage/avatars/default-image.jpg') }}" class="img-fluid avatar-lg rounded-circle" id="preview-avatar">
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#input-avatar').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-avatar').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
        $('#input-avatar').on('change', function () {
            if ($(this).val() === '') {
                $('#preview-avatar').attr('src', '{{ asset('storage/avatars/default-image.jpg') }}');
            }
        });
    </script>
@endpush
