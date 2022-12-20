@extends('layout.master')
@section('content')
    <div style="display: flex; justify-content: space-between">
        <a class="btn btn-primary" href="{{ route('makers.index') }}">Back</a>
        <div style="display: flex">
            <div>
                <a class="btn btn-primary" href="{{ URL::to('makers/edit/' . $maker->id) }}" style="margin-right: 10px;">Edit</a>
            </div>
            <div>
                <form action="{{ route('makers.destroy', $maker->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <input class="btn btn-danger" type="submit" onclick="return window.confirm('Are you sure?');"
                           value="Delete"/>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">

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
                                <a href="javascript: void(0);" class="text-center d-block mb-4">
                                    <img src="/images/maker/{{ isset($maker->logo) ? $maker->logo : 'default-image.jpg' }}" class="img-fluid" style="width: 100%; max-height: 500px"
                                         alt="Maker-img"/>
                                </a>
                            </div> <!-- end col -->

                            <div class="col-lg-7">
                                <form class="pl-lg-4">
                                    <!-- Product title -->
                                    <h3 style="font-size: 40px" class="mt-0">{{$maker->name}} <a href="javascript: void(0);" class="text-muted"></a></h3>

                                    <p class="font-16">
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                        <span class="text-warning mdi mdi-star"></span>
                                    </p>
                                    <div class="mt-4">
                                        <h6 class="font-14">Made by: {{ $user->name ?? '' }}</h6>
                                        <h4 class="font-14"> {{ $maker->created_at }}</h4>
                                    </div>

                                    <!-- Product stock -->
                                    <div class="mt-4">
                                        <h6 class="font-14">Code:</h6>
                                        <h3> {{ $maker->code }}</h3>
                                    </div>

                                    <!-- Product description -->
                                    <div class="mt-4">
                                        <h6 class="font-14">Phone:</h6>
                                        <h3> {{ $maker->phone }}</h3>
                                    </div>

                                    <div class="mt-4">
                                        <h6 class="font-14">Address:</h6>
                                        <p>{{ $maker->address }} </p>
                                    </div>


                                    <div class="mt-4">
                                        <h6 class="font-14">Description:</h6>
                                        <p>{{ $maker->description }} </p>
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

@endsection
