@extends('layout.master')
@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
@section('content')
    <div style="width: 100%; display: flex;justify-content: space-between">
        <div class="col-sm-4" style="padding: 0">
            <a href="{{ route('products.create') }}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i>
                Add
                Products</a>
        </div>
        <div style="padding: 0; ">
            <form action="" method="get" style="display: flex">
                @csrf
                <input type="search" name="search" id="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                <button name="submit" class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
        <div>
            <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#modalCSV">
                Import CSV
            </button>
            <button class="btn btn-success mb-2" id="btnExportToCsv">Export to CSV</button>
        </div>


    </div>
    <div id="data">
        @include('product.item')
    </div>
@endsection

@push('scripts')
    <script src="{{asset('js/paginateAjax.min.js')}}"></script>
@endpush
