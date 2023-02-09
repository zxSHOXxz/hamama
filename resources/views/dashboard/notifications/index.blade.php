@extends('dashboard.master')
@section('title', 'المشرف')

@section('main-title', 'عرض المشرف')
@section('sub-title', 'عرض المشرف')

@section('styles')
    <style>
        .dropdown-item.active,
        .dropdown-item:active {
            color: #007bff !important;
            text-decoration: none;
            background-color: #007bff00 !important;
        }

        #example1_wrapper.dataTables_wrapper.dt-bootstrap4.no-footer .col-sm-12.col-md-6 {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        #example1_wrapper.dataTables_wrapper.dt-bootstrap4.no-footer .row {
            display: flex !important;
            justify-content: space-between !important;
            flex-wrap: nowrap !important;
        }
    </style>
@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-header  d-flex justify-end">
                            <h3 class="card-title">الاشعارات</h3>
                        </div>
                        <div class="card-body">
                            <div id="example1_wrapper">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1"
                                            class="table table-bordered table-striped dataTable dtr-inline"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th>الاشعار</th>
                                                    <th>التوقيت</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($notifications as $notification)
                                                    <tr class="odd">
                                                        <td class="sorting_1 dtr-control @if ($notification->unread()) text-bold @endif"
                                                            tabindex="0" style="">
                                                            <a class="text-decoration-none"
                                                                href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}">
                                                                {{ $notification->data['body'] }}
                                                            </a>
                                                        </td>
                                                        <td style=""
                                                            class="@if ($notification->unread()) text-bold @endif">
                                                            {{ $notification->created_at->shortAbsoluteDiffForHumans() }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>


@endsection

@section('scripts')
    <script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('cms/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('cms/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('cms/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('cms/dist/js/adminlte.min.js?v=3.2.0') }}"></script>

    <script src="{{ asset('cms/dist/js/demo.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                lengthMenu: [
                    [15, 10, 50, 100, -1],
                    [15, 25, 50, 100, "All"]
                ],
                order: [
                    [3, 'desc']
                ],
                "buttons": [{
                        "extend": 'copy',
                        "text": 'نسخ'
                    },
                    {
                        "extend": 'print',
                        "text": 'طباعة'
                    },
                    {
                        "extend": 'colvis',
                        "text": 'الاعمدة'
                    }
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            let row = document.querySelector('#example1_length label')
            let row2 = document.querySelector('#example1_filter')
            let row3 = row2.parentElement.parentElement
            row.innerHTML =
                `<select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm"><option value="15">15</option><option value="10">25</option><option value="50">50</option><option value="100 ">100</option><option value=" - 1 ">All</option></select>`
            row2.innerHTML =
                `<input type="search" class="form-control form-control-sm" placeholder=" البحث " aria-controls="example1">`
            row2.parentElement.style = "justify-content : center !important"
            console.log(row3.classList.add('pb-3'));
        });
    </script>
@endsection
