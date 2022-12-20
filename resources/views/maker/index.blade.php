@extends('layout.master')
@section('content')
    <div style="width: 100%; display: flex;justify-content: space-between">
        <div class="col-sm-4" style="padding: 0">
            <a href="{{ route('makers.create') }}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i>
                Add Maker
            </a>
        </div>
        <div>
            <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#modalCSV">
                Import CSV
            </button>
            <button class="btn btn-success mb-2" id="btnExportToCsv">Export to CSV</button>
        </div>

    </div>
    <div style="padding: 3px">
        <form>
            Show
            <select id="pagination">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
            </select>
            item
        </form>
    </div>

    <div id="data">
        @include('maker.item')
    </div>

@endsection
@push('scripts')
    {{--    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>--}}
    <script src="{{asset('js/paginateAjax.min.js')}}"></script>

@endpush
