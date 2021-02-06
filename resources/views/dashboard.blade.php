@extends('layouts.app1')
@section('title_for_layout','Dashboard')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection
@section('bread')

@endsection
@section('content')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body album">
                    <h3 class="card-title text-center font-weight-bold">Danh sách ảnh bìa</h3>
                    {{-- <p class="text-center">(Upload unlimited and can change the position)</p> --}}
                    <div class="album--form">
                    <form id="upload-form" method="POST" action="{{ route('save.banners') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="1" name="bannerweb">
                        <div class="row">
                        <div class="col-6">
                            <label for="name">Chọn hình ảnh</label>
                            <div class="form-group">
                                <label for="image"><i class="fas fa-upload"></i></label>
                                <input type="file" name="album[]" id="image" multiple accept="image/*">
                            </div>
                        </div>
                        </div>
                    </form>
                    </div>
                    @if(!empty($banners))
                    <label for="name">Image</label>
                        <div class="row el-element-overlay mt-5" id="list-album">
                            @foreach($banners as $value)
                            <div class="col-lg-4 col-md-6 item">
                                <div class="card">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"> <img src="{{ asset($value->image) }}" alt="Image">
                                            <div class="el-overlay">
                                                <ul class="list-style-none el-info">
                                                    <li class="el-item">
                                                            <a class="btn btn-danger btn-outline el-link btn-delete" data-album-id = "{{ $value->id }}"
                                                            data-album-name = "{{ $value->image }}" href="{{ route('delete.banner') }}">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-info">Slide image not found!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection
@push('scripts')
<script type="application/javascript">
</script>
<script src="{{ asset('/xtreme-admin/assets/libs/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('/xtreme-admin/assets/libs/sweetalert2/sweet-alert.init.js')}}"></script>

<script>

    $(document).ready(function(){
        function checkImage(filename, filesize) {
            var fileType = filename.split('.').pop().trim().toLowerCase();
            var validImageTypes = ["gif", "jpeg", "png", "jpg"];
            if ($.inArray(fileType, validImageTypes) < 0) {
                alert('Invalid image format! Image format must be JPG, JPEG, PNG or GIF.');
                return false;
            }
            if (filesize > 10000000) {
                return false;
            }
            return true;
        }

        $('#image_background').change(function(e) {
            var files = $('#image_background')[0].files;
            for (var i=0, f; f=files[i]; i++) {
                var filename = f.name;
                var filesize = f.size;
                if (!checkImage(filename, filesize)) {
                    $(this).val('');
                    swal({
                        type: 'warning',
                        title: 'Upload fail!',
                        text: 'Image ' + filename + ' may not be greater 10MB.'
                    });
                    return false;
                }
            }
            $('#upload-form').submit();
        });

        $('#image').change(function(e) {
            var files = $('#image')[0].files;
            for (var i=0, f; f=files[i]; i++) {
                var filename = f.name;
                var filesize = f.size;
                if (!checkImage(filename, filesize)) {
                    $(this).val('');
                    swal({
                        type: 'warning',
                        title: 'Upload fail!',
                        text: 'Image ' + filename + ' may not be greater 10MB.'
                    });
                    return false;
                }
            }
            $('#upload-form').submit();
        });

        $('.btn-delete').click(function(e) {
            e.preventDefault();
            var me = $(this),
                url = me.attr('href'),
                id =  me.attr('data-album-id'),
                csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal.fire({
                title: '',
                text: 'Bạn có muốn xóa ảnh bìa?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
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
                            swal({
                                type: 'success',
                                title: '',
                                text: 'Xóa hình ảnh thành công!'
                            });
                            location.reload();
                        },
                        error: function(xhr){
                            swal({
                                type: 'warning',
                                title: '',
                                text: 'Xóa hình ảnh thất bại!'
                            });
                            console.log(xhr);
                        }
                    });
                }
            });
        });
    });
</script>

@endpush
