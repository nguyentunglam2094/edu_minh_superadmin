@extends('layouts.app1')
@section('title_for_layout','Thêm đề thi online')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/xtreme/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.date.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.time.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@endsection
@section('bread')

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center font-weight-bold">Thêm bài thi</h3>
                    <form class="mt-4" method="POST" action="{{ route('add.test') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-12 col-md-12">
                            {{-- <div class="row midtext"><h3>Add food</h3></div> --}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Chọn file đề thi</label><br>
                                            {{-- <input type="file" name="image" id="image" accept="image/*"> --}}
                                            <input type="file" name="image" id="image">
                                        </div>
                                        <span class="text-danger" id="error-image" style="display:none;"></span>
                                        @if ($errors->has('image'))
                                            <span class="text-danger pt-2 error-image">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Tên đề thi <span class="text-danger">*</span></label>
                                        @if($errors->has('title'))
                                            <input type="text" class="form-control is-invalid"  placeholder="Tên đề thi" name="title" value="{{ old('title') }}"  >
                                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                        @else
                                            <input type="text" class="form-control" placeholder="Tên đề thi" name="title" value="{{ old('title') }}" >
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Môn học <span class="text-danger">*</span></label>
                                        <select class="select2 form-control custom-select" name="subject_id" id="subject_id" style="width: 100%; height:36px;">
                                            @foreach ($listSubject as $subj)
                                                <option value="{{ $subj->id }}" {{ old('subject_id') == $subj->id ? 'selected' : '' }}>{{ $subj->title }}</option>
                                            @endforeach
                                        </select>
                                    @if($errors->has('subject_id'))
                                    <div class="invalid-feedback">{{ $errors->first('subject_id') }}</div>
                                    @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Lớp <span class="text-danger">*</span></label>
                                        <select class="select2 form-control custom-select" name="class_id" style="width: 100%; height:36px;">
                                            @foreach ($listClass as $class)
                                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->title }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('class_id'))
                                            <div class="invalid-feedback">{{ $errors->first('class_id') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Số lượng câu hỏi</label>
                                        @if($errors->has('question_number'))
                                            <input type="text" class="form-control is-invalid" placeholder="Số lượng câu hỏi" name="question_number" value="{{ old('question_number') }}" >
                                            <div class="invalid-feedback">{{ $errors->first('question_number') }}</div>
                                        @else
                                            <input type="text" class="form-control" placeholder="Số lượng câu hỏi" name="question_number" value="{{ old('question_number') }}" >
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Thời gian làm bài</label>
                                        @if($errors->has('min'))
                                            <input type="text" class="form-control is-invalid" name="min" value="{{ old('min') }}" >
                                            <div class="invalid-feedback">{{ $errors->first('min') }}</div>
                                        @else
                                            <input type="text" class="form-control" name="min" value="{{ old('min') }}" >
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Lưu và thêm câu trả lời</button>
                        <a href="" class="btn btn-dark">Hủy</a>
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
<script src="{{ asset('xtreme/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>

<script src="{{ asset('/xtreme/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('/xtreme/dist/js/app-style-switcher.js') }}"></script>

<!-- This Page JS -->
<script src="{{ asset('xtreme/assets/libs/moment/moment.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('xtreme/assets/libs/pickadate/lib/compressed/picker.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/pickadate/lib/compressed/picker.date.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/pickadate/lib/compressed/picker.time.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/pickadate/lib/compressed/legacy.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/daterangepicker/daterangepicker.js') }}"></script>


<script>
    $('#start_at, #end_at').pickatime({
        interval: 15,
        format: 'H:i',
    });
</script>

<script type="text/javascript">
	$(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();

	function readURL(input, imgControlName) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
			  	$(imgControlName).attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#removeImage").click(function(e) {
		e.preventDefault();
		$("#image").val("");
		$("#ImgPreview").attr("src", "{{ asset('img/no-image.jpg') }}");
	});


	$(document).ready(function(){
		// preview image
		$('#image').bind('change', function() {
    		var a = 1;
			var ext = $(this).val().split('.').pop().toLowerCase();
			var picsize = (this.files[0].size);
			if (picsize > 0) {
				if ($.inArray(ext, ['pdf']) == -1){
					$('#error-image').html('The image is not in the correct format');
				 	$('#error-image').slideDown("slow");
				 	$('.error-image').hide();
				 	$("#image").val("");
				 	a=0;
				}
				if (picsize > 50000000){
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
        ajaxSelectArticle();
	});
</script>

@endpush


