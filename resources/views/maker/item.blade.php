

<table class="table table-hover table-centered mb-0" id="example">
    <thead class="thead-dark">
    <tr>
        <th>@sortablelink('code')</th>
        <th>@sortablelink('name')</th>
        <th>Logo</th>
        <th>Address</th>
        <th>Phone</th>
    </tr>
    </thead>
    <tbody >
    @foreach ($makers as $data)
        <tr>
            <td>{{ $data->code }}</td>
            <td><a href="{{ URL::to('makers/detail/' . $data->id) }}">{{ $data->name }}</a></td>

            <td><img class="mr-2 rounded-circle img-fluid avatar-lg rounded-circle"
                     src="images/maker/{{ isset($data->logo) ? $data->logo : 'default-image.jpg' }}  " alt=""
                     style="width: 100px; height: 100px"></td>

            <td>{{ $data->address }}</td>
            <td>{{ $data->phone }}</td>
        </tr>
    @endforeach

    </tbody>

</table>
<br>
{{ $makers->links() }}
<script src="{{ asset('js/CSV.min.js') }}"></script>


