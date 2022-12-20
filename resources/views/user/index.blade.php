@extends('layout.master')
@push('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
@endpush
@section('content')
    <div style="width: 100%; display: flex;justify-content: space-between">
        <div class="col-sm-4" style="padding: 0">
            <a href="{{ route('users.create') }}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i>
                Add User
            </a>
        </div>
        <div>
            <button type="button" class="btn btn-info mb-2" data-toggle="modal" data-target="#modalCSV">
                Import CSV
            </button>
            <button class="btn btn-success mb-2" id="btnExportToCsv">Export to CSV</button>
        </div>

    </div>
    <div id="data">
        @include('user.item')
    </div>


    <div id="modalCSV" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import CSV</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-horizontal">
                    <div class="form-group">
                        <label>File</label>
                        <input
                            type="file"
                            name="csv"
                            id="csv"
                            class="form-control"
                            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                        >
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" id="btn-import-csv">
                            Import
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('js/paginateAjax.min.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btn-import-csv").click(function () {
            let formData = new FormData();
            formData.append('file', $('#csv')[0].files[0]);
            $.ajax({
                url: '{{ route('users.import_csv') }}',
                type: 'POST',
                dataType: 'json',
                enctype: 'multipart/form-data',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function () {
                    $.toast({
                        heading: 'Import Success',
                        text: 'Your data have been imported',
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'success'
                    })
                },
                error: function () {
                    $.toast({
                        heading: 'Import Error',
                        text: 'Your data have not been imported',
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'error'
                    })
                },
            });
        });
    </script>
@endpush
