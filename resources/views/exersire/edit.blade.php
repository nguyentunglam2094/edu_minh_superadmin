@extends('layouts.app1')
@section('title_for_layout','Thêm bài tập')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/xtreme/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.date.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.time.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/ckeditor/samples/css/samples.css') }}">
<!-- Custom CSS -->
<link href="{{ asset('xtreme/dist/css/style.min.css') }}" rel="stylesheet">

@endsection
@section('bread')

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <h3 class="card-title text-center font-weight-bold">Sửa bài tập</h3>
                    <form class="mt-4" method="POST" action="{{ route('update.exer') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" value="{{ $detailEx->id }}">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name">Tiêu đề <span class="text-danger">*</span></label>
                                @if($errors->has('question'))
                                    <input type="text" class="form-control is-invalid"  placeholder="Nhập tiêu đề bài tập" name="question" value="{{ $detailEx->question }}"  >
                                    <div class="invalid-feedback">{{ $errors->first('question') }}</div>
                                @else
                                    <input type="text" class="form-control" placeholder="Nhập tiêu đề bài tập" name="question" value="{{ $detailEx->question }}" >
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name">Mã bài tập <span class="text-danger">*</span></label>
                                @if($errors->has('code'))
                                    <input type="text" class="form-control is-invalid"  placeholder="Nhập code bài tập" name="code" value="{{ $detailEx->code }}"  >
                                    <div class="invalid-feedback">{{ $errors->first('code') }}</div>
                                @else
                                    <input type="text" class="form-control" placeholder="Nhập code bài tập" name="code" value="{{ $detailEx->code }}" >
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name">Chọn đáp án đúng<span class="text-danger">*</span></label>
                                <select class="select2 form-control custom-select" name="answer_select" id="answer_select" style="width: 100%; height:36px;">
                                    <option value="1" {{ $detailEx->answer_select == 1 ? 'selected' : '' }}>Đáp án A</option>
                                    <option value="2" {{ $detailEx->answer_select == 2 ? 'selected' : '' }}>Đáp án B</option>
                                    <option value="3" {{ $detailEx->answer_select == 3 ? 'selected' : '' }}>Đáp án C</option>
                                    <option value="4" {{ $detailEx->answer_select == 4 ? 'selected' : '' }}>Đáp án D</option>
                                </select>
                            @if($errors->has('answer_select'))
                            <div class="invalid-feedback">{{ $errors->first('answer_select') }}</div>
                            @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Chọn lớp<span class="text-danger">*</span></label>
                                <select class="select2 form-control custom-select" name="class_id" id="class_id" style="width: 100%; height:36px;">
                                    @foreach ($listClass as $class)
                                    <option value="{{ $class->id }}" {{ $detailEx->class->id == $class->id ? 'selected' : '' }}>{{ $class->title }}</option>
                                    @endforeach
                                </select>
                            @if($errors->has('class_id'))
                            <div class="invalid-feedback">{{ $errors->first('class_id') }}</div>
                            @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Chọn môn học<span class="text-danger">*</span></label>
                                <select class="select2 form-control custom-select" name="subject_id" id="subject_id" style="width: 100%; height:36px;">
                                    @foreach ($listSubject as $subject)
                                    <option value="{{ $subject->id }}" {{ $detailEx->subject->id == $subject->id ? 'selected' : '' }}>{{ $subject->title }}</option>
                                    @endforeach
                                </select>
                            @if($errors->has('subject_id'))
                            <div class="invalid-feedback">{{ $errors->first('subject_id') }}</div>
                            @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Ảnh câu hỏi <span class="text-danger">*</span></label>
                                @if($errors->has('image_question'))
                                    <input type="text" class="form-control is-invalid" name="image_question" id="image_question" value="{{ $detailEx->image_question }}"  >
                                    <div class="invalid-feedback">{{ $errors->first('image_question') }}</div>
                                @else
                                    <input type="text" class="form-control" name="image_question" id="image_question" value="{{ $detailEx->image_question }}" >
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Ảnh câu trả lời <span class="text-danger">*</span></label>
                                @if($errors->has('image_answer'))
                                    <input type="text" class="form-control is-invalid" id="image_answer" name="image_answer" value="{{ $detailEx->image_answer }}"  >
                                    <div class="invalid-feedback">{{ $errors->first('image_answer') }}</div>
                                @else
                                    <input type="text" class="form-control" id="image_answer" name="image_answer" value="{{ $detailEx->image_answer }}" >
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
								<label>Ảnh câu hỏi</label><br>
                            </div>
							<div class="preview-image mb-2">
								<img src="{{ asset($detailEx->image_question) }}" class="img-fluid avatar" alt="">
							</div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
								<label>Ảnh câu trả lời</label><br>
                            </div>
							<div class="preview-image mb-2">
								<img src="{{ asset($detailEx->image_answer) }}" class="img-fluid avatar" alt="">
							</div>
                        </div>

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                        <a href="" class="btn btn-dark">Cancel</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

<script src="{{ asset('xtreme/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/pages/forms/select2/select2.init.js') }}"></script>

<!-- This Page JS -->
<script src="{{ asset('xtreme/assets/libs/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/ckeditor/samples/js/sample.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/custom.min.js') }}"></script>


<script>

    $('#image_question').on('paste', function(event){
        var items = (event.clipboardData || event.originalEvent.clipboardData).items;
        for (var i = 0 ; i < items.length ; i++) {
            var item = items[i];
            if (item.type.indexOf("image") != -1) {
                var file = item.getAsFile();
                console.log(file);
                upload_file_with_ajax(file, '#image_question');
            }
        }
    });

    $('#image_answer').on('paste', function(event){
        var items = (event.clipboardData || event.originalEvent.clipboardData).items;
        for (var i = 0 ; i < items.length ; i++) {
            var item = items[i];
            if (item.type.indexOf("image") != -1) {
                var file = item.getAsFile();
                console.log(file);
                upload_file_with_ajax(file, '#image_answer');
            }
        }
    });


    function upload_file_with_ajax(file, id_input){
      var formData = new FormData();
      formData.append('file', file);

      $.ajax({
            url: '{{ route('upload.chipboash') }}',
            type: 'POST',
            async: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
          success: function (rel) {
              $(id_input).val(rel);
          },
          error: function(){
          }
      });
    }

    </script>

@endpush


