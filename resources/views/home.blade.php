@extends('layout.master')
@push('css')
    <style>
        p {
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 25px;
            -webkit-line-clamp: 3;
            height: 75px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
        }
    </style>
@endpush
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
                        <td><p>{{ $news->title }}</p></td>
                        <td><p>{{ $news->content }}</p></td>
                    </tr>
                @endforeach
                <tr>
                    <td style="text-align: center" colspan="12">
                        <i id="load_more" class="mdi mdi-arrow-down-thick">Load More</i>
                    </td>
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
                <tr>
                    <td style="text-align: center" colspan="12">
                        <i id="load_more" class="mdi mdi-arrow-down-thick">Load More</i>
                    </td>
                </tr>
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
                <tr>
                    <td style="text-align: center" colspan="12">
                        <i id="load_more" class="mdi mdi-arrow-down-thick">Load More</i>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
