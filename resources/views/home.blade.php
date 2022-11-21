@extends('layout.master')

@section('content')

    <div class="card">
        <div class="card-body">
            <h1>Top 10 News</h1>
            <a style="float: right; border-radius: 10px" href="" class="btn btn-primary">
                Add News
            </a><br><br>
            <table id="table_news" class="table table-centered mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $topTenNews as $news )
                    <tr>
                        <td>{{ $news->title }}</td>
                        <td>{{ $news->content }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="12"><i id="see_more" class=" uil-corner-left-down">See More</i></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h1>Top 10 Products</h1>
            <a style="float: right; border-radius: 10px" href="" class="btn btn-primary">
                Add Products
            </a><br><br>
            <table class="table table-centered mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $topTenProducts as $products )
                    <tr>
                        <td>{{ $products->code }}</td>
                        <td>{{ $products->name }}</td>
                        <td><img src="{{ asset('storage/'.$products->image) }}" alt="" width="100px"></td>
                        <td>{{ number_format($products->price)}} VNĐ</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h1>Top 10 Users</h1>
            <a style="float: right; border-radius: 10px" href="" class="btn btn-primary">
                Add Users
            </a><br><br>
            <table class="table table-centered mb-0">
                <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Birthday</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $topTenUsers as $users )
                    <tr>
                        <td class="table-user">
                            <img src="{{ asset('images/default-image.jpg') }}" alt="table-user"
                                 class="mr-2 rounded-circle">
                            {{ $users->name }}
                        </td>
                        <td>{{ $users->email }}</td>
                        <td>{{ $users->phone }}</td>
                        <td>{{ $users->birthday }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        const limit = 2;
        let start = 0;

        function load_data_ajax(limit, start){
            $.ajax({
                url: "fetch_data.php",
                type: "get",
                data: {
                    limit: limit,
                    start: start
                },
                dataType: "json",
                success: function (result) {
                    console.log(result);
                }
            })
        }

        load_data_ajax(limit, start);
        $('#see_more').click(function () {
            start += limit;
            load_data_ajax(limit, start);
        })
    </script>
@endsection
