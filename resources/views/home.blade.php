<div>
    <div class="card">
        <div class="card-body">
            <h1>Top 10 News</h1>

            @if (checkAdmin())
                <div class="col-sm-12" style="text-align: right">
                    <a href="{{ route('news.create') }}" class="btn btn-success mb-2"><i
                            class="mdi mdi-plus-circle mr-2"></i> Add News</a>
                </div>
            @endif

            <table id="table_news" class="table table-centered mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topTenNews as $news)
                        <tr>
                            <td><a href="{{ URL::to('news/detail/' . $news->id) }}">{{ $news->title }}</a></td>
                            <td>
                                <p
                                    style="width: 350px;
                                            overflow: hidden;
                                            white-space: nowrap;
                                            text-overflow: ellipsis;">
                                    {{ $news->content }}</p>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        @if (count($topTenNews) < 10)
                            <td style="text-align: center" colspan="12">
                                <button class="btn btn-success my-4" wire:click='loadMoreNews'>
                                    Load More
                                </button>
                            </td>
                        @else
                            <td style="text-align: center" colspan="12">
                                <button class="btn btn-success my-4" wire:click='loadLessNews'>
                                    Load Less
                                </button>
                            </td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h1>Top 10 Products</h1>
            @if (checkAdmin())
                <div class="col-sm-12" style="text-align: right">
                    <a href="" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add
                        Products</a>
                </div>
            @endif
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
                        <td><a href="{{ route('products.show', $products->id) }}">{{ $products->name }}</a></td>
{{--                        <td><img src="{{ asset('storage/'.$products->image) }}" alt="" width="100px"></td>--}}
                        <td>{{ number_format($products->price)}} VNĐ</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="text-align: center" colspan="12">
                        @if ( count($topTenProducts) < 10 )
                            <button class="btn btn-success my-4" wire:click='loadMoreProduct'>
                                <i id="load_more" class="dripicons-chevron-down"> Load More</i>
                            </button>
                        @else
                            <button class="btn btn-success my-4" wire:click='loadLessProduct'>
                                <i id="load_less" class="dripicons-chevron-up"> Load Less</i>
                            </button>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    @if( checkAdmin() )
        <div class="card">
            <div class="card-body">
                <h1>Top 10 Users</h1>
                <div class="col-sm-12" style="text-align: right">
                    <a href="" class="btn btn-success mb-2"><i
                            class="mdi mdi-plus-circle mr-2"></i> Add User</a>
                </div>
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

                    @foreach ($topTenProducts as $products)

                        <tr>
                            <td>{{ $products->code }}</td>
                            <td>{{ $products->name }}</td>
                            <td><img src="{{ asset('images/products/default/meme-meo-like-trong-dau-kho.jpg') }}"
                                    alt="" width="100px">
                            </td>
                            <td>{{ number_format($products->price) }} VNĐ</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="text-align: center" colspan="12">
                            @if (count($topTenProducts) < 10)
                                <button class="btn btn-success my-4" wire:click='loadMoreProduct'>
                                    Load More
                                </button>
                            @else
                                <button class="btn btn-success my-4" wire:click='loadLessProduct'>
                                    Load Less
                                </button>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
    <!-- </div> -->

    @if (checkAdmin())
        <div class="card">
            <div class="card-body">
                <h1>Top 10 Users</h1>
                <div class="col-sm-12" style="text-align: right">
                    <a href="" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add User</a>
                </div>
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
                        @foreach ($topTenUsers as $users)
                            <tr>
                                <td class="table-user">
                                    <img src="{{ asset('images/default-image.jpg') }}" alt="table-user"
                                        class="mr-2 rounded-circle">
                                    <a href="{{ route('users.detail', $users->id) }}">{{ $users->name }}</a>
                                </td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->phone ?? 'Không có dữ liệu' }}</td>
                                <td>{{ $users->birthday ?? 'Không có dữ liệu' }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td style="text-align: center" colspan="12">
                                @if (count($topTenUsers) < 10)
                                    <button class="btn btn-success my-4" wire:click='loadMoreUser'>
                                        Load More
                                    </button>
                                @else
                                    <button class="btn btn-success my-4" wire:click='loadLessUser'>
                                        Load Less
                                    </button>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>
