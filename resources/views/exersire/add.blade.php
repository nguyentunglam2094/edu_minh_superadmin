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
                    <h3 class="card-title text-center font-weight-bold">Thêm bài tập</h3>
                    <form class="mt-4" method="POST" action="{{ route('add.exersire') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name">Dạng bài tập <span class="text-danger">*</span></label>
                                <select class="select2 form-control custom-select" name="type" id="type" style="width: 100%; height:36px;">
                                    @foreach ($typeList as $type)
                                        <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>
                                    @endforeach
                                </select>
                            @if($errors->has('type'))
                                <div class="invalid-feedback">{{ $errors->first('type') }}</div>
                            @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name">Code <span class="text-danger">*</span></label>
                                @if($errors->has('code'))
                                    <input type="text" class="form-control is-invalid"  placeholder="Nhập code bài tập" name="code" value="{{ old('code') }}"  >
                                    <div class="invalid-feedback">{{ $errors->first('code') }}</div>
                                @else
                                    <input type="text" class="form-control" placeholder="Nhập code bài tập" name="code" value="{{ old('code') }}" >
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name">Chọn đáp án đúng<span class="text-danger">*</span></label>
                                <select class="select2 form-control custom-select" name="answer_select" id="answer_select" style="width: 100%; height:36px;">
                                    <option value="1" {{ old('answer_select') == 1 ? 'selected' : '' }}>Đáp án A</option>
                                    <option value="2" {{ old('answer_select') == 2 ? 'selected' : '' }}>Đáp án B</option>
                                    <option value="3" {{ old('answer_select') == 3 ? 'selected' : '' }}>Đáp án C</option>
                                    <option value="4" {{ old('answer_select') == 4 ? 'selected' : '' }}>Đáp án D</option>
                                </select>
                            @if($errors->has('type'))
                            <div class="invalid-feedback">{{ $errors->first('type') }}</div>
                            @endif
                            </div>
                        </div>

                        {{-- <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Nội dung câu hỏi</h4>
                                    <div class="form-group">
                                        <textarea name="ckeditor" id="ckeditor" cols="50" rows="15" class="ckeditor"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
								<label>Chọn ảnh bài tập</label><br>
								<input type="file" name="image_question" id="image_question">
                            </div>
                            <span class="text-danger" id="error-image" style="display:none;"></span>
							@if ($errors->has('image'))
							<span class="text-danger pt-2 error-image">{{ $errors->first('image') }}</span>
							@endif
							<div class="preview-image mb-2">
								<img id="ImgPreview" src="{{ asset('img/no-image.jpg') }}" class="img-fluid avatar" alt="">
							</div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
								<label>Chọn ảnh lời giải bài tập</label><br>
								{{-- <input type="file" name="image" id="image" accept="image/*"> --}}
								<input type="file" name="image_answer" id="image_answer">
                            </div>
                            <span class="text-danger" id="error-image" style="display:none;"></span>
							@if ($errors->has('image'))
							    <span class="text-danger pt-2 error-image">{{ $errors->first('image') }}</span>
							@endif
							<div class="preview-image mb-2">
								<img id="ImgPreview_answer" src="{{ asset('img/no-image.jpg') }}" class="img-fluid avatar" alt="">
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
    $('#start_at, #end_at').pickatime({
        interval: 15,
        format: 'H:i',
	});
</script>

<script>
    initSample();

    //inline editor
    // We need to turn off the automatic editor creation first.
    CKEDITOR.disableAutoInline = true;

    CKEDITOR.inline('editor2', {
        extraPlugins: 'sourcedialog',
        removePlugins: 'sourcearea'
    });

    var editor1 = CKEDITOR.replace('editor1', {
        extraAllowedContent: 'div',
        height: 460
    });
    editor1.on('instanceReady', function() {
        // Output self-closing tags the HTML4 way, like <br>.
        this.dataProcessor.writer.selfClosingEnd = '>';

        // Use line breaks for block elements, tables, and lists.
        var dtd = CKEDITOR.dtd;
        for (var e in CKEDITOR.tools.extend({}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent)) {
            this.dataProcessor.writer.setRules(e, {
                indent: true,
                breakBeforeOpen: true,
                breakAfterOpen: true,
                breakBeforeClose: true,
                breakAfterClose: true
            });
        }
        // Start in source mode.
        this.setMode('source');
    });
</script>

<script type="text/javascript">
	$(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    $('#fullTime').change(function () {
        alert('a');
    })

	function readURL(input, imgControlName) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
			  	$(imgControlName).attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(document).ready(function(){
		// preview image
		$('#image_question').bind('change', function() {
    		var a = 1;
			var ext = $(this).val().split('.').pop().toLowerCase();
			var picsize = (this.files[0].size);
			if (picsize > 0) {
				if ($.inArray(ext, ['gif','png','jpg','jpeg','svg']) == -1){
					$('#error-image').html('The image is not in the correct format');
				 	$('#error-image').slideDown("slow");
				 	$('.error-image').hide();
				 	$("#image").val("");
				 	a=0;
				}
				if (picsize > 10000000){
			 		$('#error-image').html('Photos cannot be larger than 10Mb');
			 		$('#error-image').slideDown("slow");
			 		$('.error-image').hide();
			 		$("#image").val("");
			 		a=0;
			 	}
			 	if (a==1){
                    $('.error-image').hide();
			 		$('#error-image').slideUp("slow");
			 		var imgControlName = "#ImgPreview";
					readURL(this, imgControlName);
					$('.preview-image').show();
			 	}
			}
		});

        $('#image_answer').bind('change', function() {
    		var a = 1;
			var ext = $(this).val().split('.').pop().toLowerCase();
			var picsize = (this.files[0].size);
			if (picsize > 0) {
				if ($.inArray(ext, ['gif','png','jpg','jpeg','svg']) == -1){
					$('#error-image').html('The image is not in the correct format');
				 	$('#error-image').slideDown("slow");
				 	$('.error-image').hide();
				 	$("#image").val("");
				 	a=0;
				}
				if (picsize > 10000000){
			 		$('#error-image').html('Photos cannot be larger than 10Mb');
			 		$('#error-image').slideDown("slow");
			 		$('.error-image').hide();
			 		$("#image").val("");
			 		a=0;
			 	}
			 	if (a==1){
                    $('.error-image').hide();
			 		$('#error-image').slideUp("slow");
			 		var imgControlName = "#ImgPreview_answer";
					readURL(this, imgControlName);
					$('.preview-image').show();
			 	}
			}
		});
	});
</script>

@endpush


