@extends('layouts.app1')
@section('title_for_layout','Danh sách học sinh')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('xtreme/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
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
                        <h2 class="text-center mb-4">Danh sách học sinh</h2>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-12 text-right">
                            <a href="" class="btn waves-effect waves-light btn-success btn-add"><i class="fas fa-plus"></i>Thêm mới học sinh</a>
                          </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
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

    <script src="{{ asset('xtreme/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('xtreme/dist/js/app-style-switcher.js') }}"></script>

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
                url: '{{ route('datatable.student') }}',
            },
            columns:[
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%',className:'text-center align-middle'},
                {data: 'avatar', name: 'avatar', width: '100px', className: 'text-center', orderable: false, searchable: false, render: function (data, type, row) {
                    var url = data;
                    console.log(url);
                    if (url == null) url = '{{ url('/img/no-image.jpg') }}';
                        return '<img src="' + url +'" class="img-thumbnail" alt="'+ row['avatar'] +'" width="100px" height="auto"/>';
                }},
                { data: 'name', name: 'name'},
                { data: 'email', name: 'email', width: '14%',className: 'text-center align-middle' },
                { data: 'phone', name: 'phone',width: '15%',className: 'text-center align-middle'},
                { data: 'address', name: 'address',width: '15%',className: 'text-center align-middle'},
                { data: 'verify', name: 'verify',width: '15%',className: 'text-center align-middle'},
                { data: 'action', name: 'action',width: '15%',className: 'text-center align-middle'},
            ],drawCallback: function (setting, json) {
            $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch({
                onSwitchChange: function(e, data) {
                    var inp = $(e)[0].currentTarget;
                    var active = inp.checked;
                    var id = $(inp).data('id');
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: '{{ route('active.student') }}',
                        type: 'POST',
                        data: {
                            'id':id,
                            'active':active,
                            '_method' : 'POST',
                            '_token' : csrf_token,
                        },
                        success: function (data) {
                            if(active){
                                toastr.success('Mở khóa học sinh thành công!')
                            }else{
                                toastr.success('Khóa học sinh thành công!')
                            }
                        },
                        error: function(xhr){
                            swal({
                                type: 'Warning',
                                title: '',
                                text: 'Khóa học sinh thất bại!'
                            });
                            console.log(xhr);
                        }
                    });
                }
            });
        }
        });
    });
</script>
@endpush
