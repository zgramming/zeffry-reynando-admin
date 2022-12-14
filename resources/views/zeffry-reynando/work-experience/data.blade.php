@extends('templates.template')
@section('title_header') Work Experience @endsection

@section('extends-css')
@endsection

@section('content')
    <div class="d-flex flex-sm-column flex-md-row flex-lg-row justify-content-between my-3">
        <div>
            <h3><b>Work Experience</b></h3>
        </div>
        <nav aria-label="breadcrumb" class="breadcrumb-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('zeffry-reynando/work-experience') }}">Zeffry Reynando</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Work Experience</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content mt-3">
                    <div class="card-body">

                        <div class="table-filter mb-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="d-flex flex-row">

                                        <div class="form-group position-relative has-icon-left">
                                            <input type="text" id="search" class="form-control"
                                                   placeholder="Cari berdasarkan...">
                                            <div class="form-control-icon">
                                                <i class="bi bi-search"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 mb-sm-3">
                                    <div class="d-flex flex-row justify-content-md-end justify-content-sm-start ">
                                        <div class="form-group">
                                            <div class="buttons">
                                                <a href="#" class="btn btn-success"
                                                   onclick="openBox('{{url("zeffry-reynando/work-experience/form_modal/0")}}',
                                                       {size : 'modal-lg'}
                                                       )"><span class="btn-label"><i class="fa fa-plus"></i></span>
                                                    Tambah</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @include('templates.components.messages.errors.witherrors',['errors' => $errors])
                                @include('templates.components.messages.success.withsuccess',['message' => $message = Session::get('success')])
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table" style="width: 100%" id="table_datatable">
                                <thead>
                                <tr>
                                    <th style="min-width: 50px">No</th>
                                    <th style="min-width: 200px">Pekerjaan</th>
                                    <th style="min-width: 200px">Kantor</th>
                                    <th style="min-width: 200px">Mulai</th>
                                    <th style="min-width: 200px">Selesai</th>
                                    <th style="min-width: 200px">Gambar</th>
                                    <th style="min-width: 200px">Created At</th>
                                    <th style="min-width: 200px">Updated At</th>
                                    <th style="min-width: 200px">Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extends-js')
    <script type="text/javascript">
        $(document).ready(function () {
            const url = `{{url("zeffry-reynando/work-experience/datatable")}}`;
            const jqueryDatatable = $("#table_datatable").DataTable({
                processing: true,
                serverSide: true,
                // [https://www.itsolutionstuff.com/post/laravel-datatables-filter-with-dropdown-exampleexample.html]
                ajax: {
                    url: url,
                    data: function (d) {
                        d.search = $('#search').val();
                        d.modul = $('#filter_modul').val();
                        // d.filter_status = $("#filter_status").val();
                        // Lakukan seperti ini untuk dropdown / checkbox / radio dll.
                        // d.radio = $("#radioku").val();
                    },
                },
                columns: [
                    {data: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'job.name'},
                    {data: 'company.name'},
                    {data: 'start_date'},
                    {data: 'end_date'},
                    {data: 'company_image'},
                    {data: 'created_at'},
                    {data: 'updated_at'},
                    {data: 'action', orderable: false, searchable: false},
                ],
                /// Untuk menambahkan style pada TD, lakukan disini
                /// [https://github.com/yajra/laravel-datatables/issues/456]
                createdRow: function (row, data, dataIndex) {
                    // $( row ).find('td:eq(7)').attr('style','text-align:center; vertical-align:middle;');
                    // $( row ).find('td:eq(9)').attr('style','text-align:center; vertical-align:middle;');
                },
            });

            $("#search").keyup(debounce(function () {
                jqueryDatatable.draw();
            }, 500));

        });
    </script>
@endsection
