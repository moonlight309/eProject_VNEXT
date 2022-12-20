<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Hyper - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- third party css -->
    <!-- third party css end -->
    <!-- App css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style">
    @stack('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('ckeditor/ckeditor.js') }}"></script> --}}



    @livewireStyles

</head>

<body class=""
    data-layout-config="{&quot;leftSideBarTheme&quot;:&quot;dark&quot;,&quot;layoutBoxed&quot;:false, &quot;leftSidebarCondensed&quot;:false, &quot;leftSidebarScrollable&quot;:false,&quot;darkMode&quot;:false, &quot;showRightSidebarOnStart&quot;: true}"
    data-leftbar-theme="dark">
    <!-- Begin page -->
    <div class="wrapper mm-active">
        <!-- ========== Left Sidebar Start ========== -->
        @include('layout.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <!-- Topbar Start -->
                {{--                @include('layout.header') --}}
                <!-- end Topbar -->

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->

                    <!-- end page title -->

                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="page-title">{{ $title ?? '' }}</h4>
                            </div>
                        </div>
                        @if (session()->has('success'))
                            <div class="col-12">
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                        @endif
                        <div class="col-12 ">
                            @yield('content')
                            {{ $slot ?? '' }}
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <!-- end row -->


                <!-- end row -->

            </div>
            <!-- container -->

        </div>
        <!-- content -->

        <!-- Footer Start -->
        {{--            @include('layout.footer') --}}
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <!-- /Right-bar -->

    <!-- bundle -->
{{--    <script src="{{ asset('js/ajax.min.js') }}"></script>--}}
    <script src="{{ asset('js/vendor.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>

    @stack('scripts')
    <script>
        class TableCSVExporter {
            constructor(table, includeHeaders = true) {
                this.table = table;
                this.rows = Array.from(table.querySelectorAll("tr"));

                if (!includeHeaders && this.rows[0].querySelectorAll("th").length) {
                    this.rows.shift();
                }
            }

            convertToCSV() {
                const lines = [];
                const numCols = this._findLongestRowLength();

                for (const row of this.rows) {
                    let line = "";

                    for (let i = 0; i < numCols; i++) {
                        if (row.children[i] !== undefined) {
                            line += TableCSVExporter.parseCell(row.children[i]);
                        }

                        line += (i !== (numCols - 1)) ? "," : "";
                    }

                    lines.push(line);
                }

                return lines.join("\n");
            }

            _findLongestRowLength() {
                return this.rows.reduce((l, row) => row.childElementCount > l ? row.childElementCount : l, 0);
            }

            static parseCell(tableCell) {
                let parsedValue = tableCell.textContent;

                // Replace all double quotes with two double quotes
                parsedValue = parsedValue.replace(/"/g, `""`);

                // If value contains comma, new-line or double-quote, enclose in double quotes
                parsedValue = /[",\n]/.test(parsedValue) ? `"${parsedValue}"` : parsedValue;

                return parsedValue;
            }
        }
    </script>

    <!-- third party js -->
    <!-- third party js ends -->

    <!-- demo app -->
    <!-- end demo js-->
    @livewireScripts
</body>

</html>
