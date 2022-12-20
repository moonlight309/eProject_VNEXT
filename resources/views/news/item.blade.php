<table class="table table-hover table-centered mb-0" id="example">
    <thead class="thead-dark">
    <tr>
        <th>Title</th>
        <th>Content</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($news as $data)
        <tr>
            <td><a href="{{ URL::to('news/detail/' . $data->id) }}">{{ $data->title }}</a></td>
            <td>
                <p
                    style="width: 350px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;">
                    {{ $data->content }}</p>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
{{ $news->links() }}
<script src="{{ asset('js/CSV.min.js') }}"></script>
