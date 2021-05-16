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
                        <h2 class="text-center mb-4">Danh sách bài tập</h2>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-12 text-right">
                            <a href="{{ route('view.add.exersire') }}" class="btn waves-effect waves-light btn-success btn-add"><i class="fas fa-plus"></i>Thêm bài tập mới</a>
                          </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Mã bài</th>
                                    <th>Ảnh bài tập</th>
                                    <th>Ảnh câu trả lời</th>
                                    <th>Đáp án</th>
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
        $('body').on('click', '.btn-delete', function(e){
            e.preventDefault();
            var me = $(this),
            url = me.attr('href'),
            id =  me.attr('data-id'),
            csrf_token = $('meta[name="csrf-token"]').attr('content');

            swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có muốn xóa câu hỏi?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy bỏ'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            'id':id,
                            '_method' : 'DELETE',
                            '_token' : csrf_token,
                        },
                        success: function (data) {
                            toastr.success('Xóa câu hỏi thành công!');
                            location.reload();
                        },
                        error: function(xhr){
                            toastr.error('Xóa câu hỏi thất bại!')
                        }
                    });
                }
            });
        });

        $(document).ready(function () {
            var datatable = $('#datatable').DataTable({
                responsive : true,
                processing : true,
                serverSide : true,
                stateSave: true,
                "order": [[ 0, "descriptionc" ]],
                ajax : {
                    type: 'get',
                    url: '{{ route('datatable.exercire') }}',
                },
                columns:[
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%',className:'text-center align-middle'},
                    { data: 'code', name: 'code'},
                    { data: 'image_question', name: 'image_question', width: '100px', className: 'text-center', orderable: false, searchable: false, render: function (data, type, row) {
                        var url = data;
                        if (url == null) url = '{{ url('/img/no-image.jpg') }}';
                            return '<img src="' + url +'" class="img-thumbnail" alt="'+ row['image'] +'" width="100px" height="auto"/>';
                    }},
                    { data: 'image_answer', name: 'image_answer', width: '100px', className: 'text-center', orderable: false, searchable: false, render: function (data, type, row) {
                        var url = data;
                        if (url == null) url = '{{ url('/img/no-image.jpg') }}';
                            return '<img src="' + url +'" class="img-thumbnail" alt="'+ row['image'] +'" width="100px" height="auto"/>';
                    }},
                    { data: 'selected_question', name: 'selected_question'},
                    { data: 'action', name: 'action',width: '15%',className: 'text-center align-middle',orderable: false,searchable: false},
                ]
            });
        });
    </script>
@endpush
