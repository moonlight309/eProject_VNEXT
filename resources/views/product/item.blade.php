<table class="table table-hover table-centered mb-0" id="example">
    <thead class="thead-dark">
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th style="width: 100px;">Color</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $data)
            <tr>
                <td>{{ $data->code }}</td>
                <td><a href="{{ route('products.show', $data->id) }}">{{ $data->name }}</a></td>
                <td>
                    @if ($data->image == '' || $data->image == [])
                        <img class="d-block  img-fluid avatar-lg rounded-circle"
                            src="{{ asset('images/products/default/meme-meo-like-trong-dau-kho.jpg') }}"
                            alt="First slide">
                    @else
                        <img class="d-block  img-fluid avatar-lg rounded-circle"
                            src="{{ asset('storage/products/' . $data->image[0]) }}" class="card-img-top"
                            alt="First slide">
                    @endif
                </td>
                <td>{{ number_format($data->price) }}</td>
                <td>
                    <div style="display: flex">
                        @if ($data->color != '')
                            @foreach ($data->color as $rows)
                                <div class="row my-3">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <div class="mr-2 rounded-circle"
                                            style="height: 15px; width: 15px; border: 1px solid black; background-color: {{ $rows }}; ">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach

    </tbody>
    {{--    {{ $data->links() }} --}}

</table>
<br>
{{ $products->links() }}

<script src="{{ asset('js/CSV.min.js') }}"></script>


