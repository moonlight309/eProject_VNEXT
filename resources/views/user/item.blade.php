<table class="table table-hover table-centered mb-0" id="example">
    <thead class="thead-dark">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Birthday</th>
        <th>Phone</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $data)
        <tr>
            <td class="table-user">
                <img src="{{ $data->avatar ?? asset('storage/avatars/default-image.jpg') }}" alt="avatar"
                     class="mr-2 rounded-circle">
                <a href="{{ route('users.detail', $data->id) }}">
                    {{ $data->name }}
                </a>
            </td>
            <td>{{ $data->email }}</td>
            <td>{{ Carbon\Carbon::parse($data->birthday)->format('Y-m-d') }}</td>
            <td>{{ $data->phone }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->links() }}
<script src="{{ asset('js/CSV.min.js') }}"></script>
