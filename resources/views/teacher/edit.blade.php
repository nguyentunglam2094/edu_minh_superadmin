@extends('layouts.app1')
@section('title_for_layout','Edit teacher')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/xtreme/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.date.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.time.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/ckeditor/samples/css/samples.css') }}">

@endsection
@section('bread')

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center font-weight-bold">Sửa giáo viên</h3>
                    <form class="mt-4" method="POST" action="{{ route('edit.teacher') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="form-group">
								<label>Choose avatar</label><br>
								{{-- <input type="file" name="image" id="image" accept="image/*"> --}}
								<input type="file" name="image" id="image">
                            </div>
                            <span class="text-danger" id="error-image" style="display:none;"></span>
							@if ($errors->has('image'))
							<span class="text-danger pt-2 error-image">{{ $errors->first('image') }}</span>
							@endif
							<div class="preview-image mb-2">
								<img id="ImgPreview" src="{{ $teacher->avatar }}" class="img-fluid avatar" alt="">
							</div>
                        </div>

                        <div class="col-lg-9 col-md-9 col-sm-6">
                            {{-- <div class="row midtext"><h3>Add food</h3></div> --}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Teacher name <span class="text-danger">*</span></label>
                                        @if($errors->has('name'))
                                            <input type="text" class="form-control is-invalid"  placeholder="Teacher name" name="name" value="{{ $teacher->name }}"  >
                                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        @else
                                            <input type="text" class="form-control" placeholder="Teacher name" name="name" value="{{ $teacher->name }}" >
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Subject <span class="text-danger">*</span></label>
                                        <select class="select2 form-control custom-select" name="subject" id="subject" style="width: 100%; height:36px;">
                                            @foreach ($listSubject as $subj)
                                                <option value="{{ $subj->id }}" {{ $teacher->subject_id == $subj->id ? 'selected' : '' }}>{{ $subj->title }}</option>
                                            @endforeach
                                        </select>
                                    @if($errors->has('subject'))
                                    <div class="invalid-feedback">{{ $errors->first('subject') }}</div>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Phone number<span class="text-danger">*</span></label>
                                        @if($errors->has('phone'))
                                            <input type="text" class="form-control is-invalid"  placeholder="Phone number" name="phone" value="{{ $teacher->phone }}" >
                                            <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                        @else
                                            <input type="text" class="form-control" placeholder="Phone number" name="phone" value="{{ $teacher->phone }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Email <span class="text-danger">*</span></label>
                                        @if($errors->has('email'))
                                            <input type="text" class="form-control is-invalid"  placeholder="email" name="email" value="{{ $teacher->email }}" readonly>
                                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        @else
                                            <input type="text" class="form-control" placeholder="email" name="email" value="{{ $teacher->email }}" readonly>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        @if($errors->has('address'))
                                            <input type="text" class="form-control is-invalid"  placeholder="address" name="address" value="{{ $teacher->address }}" >
                                            <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                        @else
                                            <input type="text" class="form-control" placeholder="address" name="address" value="{{ $teacher->address }}" >
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Mô tả chi tiết</label>
                                        <textarea name="description" id="ckeditor" cols="50" rows="15" class="ckeditor">{{ $teacher->description }}</textarea>
                                        @if($errors->has('description'))
                                            <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                                        @endif
                                    </div>
                                </div>
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
<script src="{{ asset('xtreme/assets/libs/ckeditor/ckeditor.js') }}"></script>
<script src=" {{ asset('xtreme/assets/libs/ckeditor/samples/js/sample.js') }}"></script>
<script>
    $('#start_at, #end_at').pickatime({

  				interval: 15,
  				format: 'H:i',
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
	$("#removeImage").click(function(e) {
		e.preventDefault();
		$("#image").val("");
		$("#ImgPreview").attr("src", "{{ asset('img/no-image.jpg') }}");
	});

    $('#article_pos').change(function(e){
        ajaxSelectArticle();
    });

	$(document).ready(function(){
		// preview image
		$('#image').bind('change', function() {
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
        ajaxSelectArticle();
	});
</script>

@endpush


