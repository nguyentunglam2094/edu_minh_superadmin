@extends('layouts.app1')
@section('title_for_layout','Test online')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection
@section('bread')

@endsection
@section('content')
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="heading">
                        <h2 class="text-center mb-4">Danh sách bài thi online</h2>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-12 text-right">
                            <a href="{{ route('view.add.test') }}" class="btn waves-effect waves-light btn-success btn-add"><i class="fas fa-plus"></i>Thêm đề thi mới</a>
                          </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Mã đề</th>
                                    <th>Môn học</th>
                                    <th>Lớp</th>
                                    <th>Tiêu đề</th>
                                    <th>Số câu hỏi</th>
                                    <th>Thời gian làm bài</th>
                                    <th width="14%">Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('xtreme/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{ asset('xtreme/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
    <script src="{{ asset('xtreme/assets/libs/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('xtreme/assets/libs/sweetalert2/sweet-alert.init.js')}}"></script>
    <script src="{{ asset('xtreme/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('xtreme/assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('xtreme/dist/js/pages/forms/select2/select2.init.js') }}"></script>
    <script>
        $(document).ready(function () {
            var datatable = $('#datatable').DataTable({
                responsive : true,
                processing : true,
                serverSide : true,
                stateSave: true,
                "order": [[ 0, "descriptionc" ]],
                ajax : {
                    type: 'get',
                    url: '{{ route('get.data.table.test') }}',
                },
                columns:[
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%',className:'text-center align-middle'},
                    { data: 'code', name: 'code'},
                    { data: 'subject', name: 'subject'},
                    { data: 'class', name: 'class'},
                    { data: 'title', name: 'title'},
                    { data: 'question_number', name: 'question_number'},
                    { data: 'min', name: 'min', width: '14%',className: 'text-center align-middle' },
                    { data: 'action', name: 'action',width: '15%',className: 'text-center align-middle',orderable: false,searchable: false},
                ]
            });
        });
    </script>
@endpush