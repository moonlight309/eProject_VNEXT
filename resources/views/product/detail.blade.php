@extends('layout.master')
@section('content')
    @if (session('sucess'))
        <div class="alert alert-success">
            {{ session('sucess') }}
        </div>
    @endif
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                            </div>
                            <div class="col-6">
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <input class="btn btn-danger" type="submit" style="float: right;"
                                        onclick="return window.confirm('Are you sure?');" value="Delete" />
                                </form>
                            </div>
                        </div>
                    </div>
                    <h4 class="page-title">Product Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <!-- Product image -->
                                @if ($product->image == '' || $product->image == [])
                                    <a href="javascript: void(0);" class="text-center d-block mb-4">
                                        <img src="{{ asset('images/products/default/meme-meo-like-trong-dau-kho.jpg') }}"
                                            class="img-fluid" style="max-width: 280px;" alt="Product-img" />
                                    </a>
                                @else
                                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            @if ($product->image != '' || $product->image != [])
                                                @foreach ($product->image as $key => $value)
                                                    <div
                                                        class="carousel-item @if ($key == 0) {{ 'active' }} @endif">
                                                        <img class="d-block img-fluid"
                                                            src="{{ asset('storage/products/' . $value) }}"
                                                            alt="First slide">
                                                    </div>
                                                @endforeach
                                            @else
                                                <img src="{{ asset('images/products/default/meme-meo-like-trong-dau-kho.jpg') }}"
                                                    alt="First slide">
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <div class="d-lg-flex d-none justify-content-center">
                                    @if ($product->image != '' || $product->image != [])
                                        @foreach ($product->image as $rows)
                                            <a href="javascript: void(0);">
                                                <img src="{{ asset('storage/products/' . $rows) }}"
                                                    class="img-fluid img-thumbnail p-2" style="max-width: 75px;"
                                                    alt="Product-img" />
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div> <!-- end col -->
                            <div class="col-lg-7">
                                <form class="pl-lg-3">
                                    <!-- Product title -->
                                    <h1 class="mt-0">{{ $product->name }}
                                    </h1>
                                    <p class="mb-1">Added Date: {{ $product->created_at }}</p>
                                    <p class="font-20">
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                    </p>
                                    <!-- Product description -->
                                    <div class="mt-4">
                                        <h6 class="font-20">Retail Price:</h6>
                                        <h3> {{ number_format($product->price) }} <span>đ</span></h3>
                                    </div>

                                    <div class="mt-4" style="display: flex">
                                        <h1 class="font-20">Color:</h1>
                                        <p>
                                            @if ($product->color != '')
                                                @foreach ($product->color as $rows)
                                                    <p
                                                        style="height: 20px; width: 20px; border: 1px solid black; background-color: {{ $rows }}; margin-left: 5px;margin-top: 10px; ">
                                                    </p>
                                                @endforeach
                                            @endif
                                        </p>
                                    </div>

                                    <div class="mt-4">
                                        <h6 class="font-20">Category:</h6>

                                        @foreach ($category as $cate)
                                            @foreach ($categoryProduct as $rows)
                                                @if ($cate->id == $rows->category_id)
                                                    <p>- {{ $cate->name }}</p>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    </div>
                                    <!-- Product description -->
                                    <div class="mt-4">
                                        <h6 class="font-20">Description:</h6>
                                        <p>{!! $product->description !!} </p>
                                    </div>
                                </form>
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div>
    <!-- container -->

    </div>
    <!-- content -->



    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
@endsection
