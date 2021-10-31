@extends('layouts.app1')
@section('title_for_layout','Exersire')
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
                        <h2 class="text-center mb-4">Thông báo</h2>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Loại comment</th>
                                    <th>Người gửi</th>
                                    <th>Read</th>
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
    <script>
        $(document).ready(function () {
            var datatable = $('#datatable').DataTable({
                responsive : true,
                processing : true,
                serverSide : true,
                stateSave: true,
                ajax : {
                    type: 'get',
                    url: '{{ route('index.notification') }}',
                },
                columns:[
                    {data: 'id', name: 'id', searchable: false, width: '5%',className:'text-center align-middle'},
                    { data: 'title', name: 'title'},
                    { data: 'content', name: 'content'},
                    { data: 'screen', name: 'screen'},
                    { data: 'sender_name', name: 'sender_name'},
                    { data: 'read', name: 'read'},
                ]
            });
        });
    </script>
@endpush
