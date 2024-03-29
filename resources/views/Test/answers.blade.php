@extends('layouts.app1')
@section('title_for_layout','Câu trả lời')
@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="{{ asset('webstudent/css/style.css') }}">

<link href="{{ asset('xtreme/dist/css/style.min.css') }}" rel="stylesheet">

@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center font-weight-bold">Chỉnh sửa đề thi</h3>
                <form class="mt-4" method="POST" action="{{ route('update.test') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="test_id" value="{{ $detail->id }}">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        {{-- <div class="row midtext"><h3>Add food</h3></div> --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>chọn file đề thi</label><br>
                                        <input type="file" name="image" id="image">
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="text-danger pt-2 error-image">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Tên đề thi <span class="text-danger">*</span></label>
                                    @if($errors->has('title'))
                                        <input type="text" class="form-control is-invalid"  placeholder="Tên đề thi" name="title" value="{{ $detail->title }}"  >
                                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                    @else
                                        <input type="text" class="form-control" placeholder="Tên đề thi" name="title" value="{{ $detail->title }}" >
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Môn học <span class="text-danger">*</span></label>
                                    <select class="select2 form-control custom-select" name="subject_id" id="subject_id" style="width: 100%; height:36px;">
                                        @foreach ($listSubject as $subj)
                                            <option value="{{ $subj->id }}" {{ $detail->subject_id == $subj->id ? 'selected' : '' }}>{{ $subj->title }}</option>
                                        @endforeach
                                    </select>
                                @if($errors->has('subject_id'))
                                <div class="invalid-feedback">{{ $errors->first('subject_id') }}</div>
                                @endif
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Lớp <span class="text-danger">*</span></label>
                                    <select class="select2 form-control custom-select" name="class_id" style="width: 100%; height:36px;">
                                        @foreach ($listClass as $class)
                                            <option value="{{ $class->id }}" {{ $detail->class_id == $class->id ? 'selected' : '' }}>{{ $class->title }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('class_id'))
                                        <div class="invalid-feedback">{{ $errors->first('class_id') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Loại đề thi <span class="text-danger">*</span></label>
                                    <select class="select2 form-control custom-select" id="type_test" name="type_test" style="width: 100%; height:36px;">

                                    </select>
                                    @if($errors->has('type_test'))
                                        <div class="invalid-feedback">{{ $errors->first('type_test') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Số lượng câu hỏi</label>
                                    @if($errors->has('question_number'))
                                        <input type="text" class="form-control is-invalid" placeholder="Số lượng câu hỏi" name="question_number" value="{{ $detail->question_number }}" >
                                        <div class="invalid-feedback">{{ $errors->first('question_number') }}</div>
                                    @else
                                        <input type="text" class="form-control" placeholder="Số lượng câu hỏi" name="question_number" value="{{ $detail->question_number }}" >
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Thời gian làm bài</label>
                                    @if($errors->has('min'))
                                        <input type="text" class="form-control is-invalid" name="min" value="{{ $detail->min }}" >
                                        <div class="invalid-feedback">{{ $errors->first('min') }}</div>
                                    @else
                                        <input type="text" class="form-control" name="min" value="{{ $detail->min }}" >
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Lưu</button>
                    <a href="" class="btn btn-dark">Hủy</a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@if (!empty($detail->file_pdf))
<section class="online_test">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h4>{{ $detail->title }}</h4>
                <div class="row mt-4">
                    <div class="col-lg-8 col-md-8">
                        <div class="box_pdf_test_online">
                            <iframe src="{{ asset($detail->file_pdf) }}" type="application/pdf" width="100%" height="800px" frameborder="0"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card card_question mt-4">
                            <div class="card-header" style="font-weight: 600;"> Điền đáp án </div>
                            <div class="card-body">
                                <div class="list_question" id="listQuestion">
                                    @foreach ($detail->answers as $answers)
                                        <div class="question_answer">
                                            <div class="title_question">Câu {{ $answers->question_number }}:
                                                <a href="#"
                                                    data-answerid="{{ $answers->id }}"
                                                    data-imageans="{{ $answers->image_answer }}"
                                                    data-questionnumber="{{ $answers->question_number }}"
                                                    class="model_img img-fluid image_ans">Thêm ảnh lời giải
                                                </a>
                                            </div>

                                            <label class="content_answer_text">
                                                <input type="radio" class="selected" data-answerid="{{ $answers->id }}" data-answer="1" name="answer{{ $answers->question_number }}" {{ $answers->selected_question == 1 ? 'checked' : '' }}>
                                                <span class="checkmark">A</span>
                                            </label>
                                            <label class="content_answer_text">
                                                <input type="radio" class="selected" data-answerid="{{ $answers->id }}" data-answer="2" name="answer{{ $answers->question_number }}" {{ $answers->selected_question == 2 ? 'checked' : '' }}>
                                                <span class="checkmark">B</span>
                                            </label>
                                            <label class="content_answer_text">
                                                <input type="radio" class="selected" data-answerid="{{ $answers->id }}" data-answer="3"  name="answer{{ $answers->question_number }}" {{ $answers->selected_question == 3 ? 'checked' : '' }}>
                                                <span class="checkmark">C</span>
                                            </label>
                                            <label class="content_answer_text">
                                                <input type="radio" class="selected" data-answerid="{{ $answers->id }}" data-answer="4"  name="answer{{ $answers->question_number }}" {{ $answers->selected_question == 4 ? 'checked' : '' }}>
                                                <span class="checkmark">D</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="title_ans"></h4>
                                </div>
                                <form id="uploadForm" enctype="multipart/form-data">
                                <div class="modal-body">
                                    @csrf
                                    <input type="hidden" name="ans_id" id="ans_id">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="name">Ảnh đáp án <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="image_question" id="image_question" value="{{ old('image_question') }}"  >
                                        </div>
                                        <span class="text-danger" id="error-image" style="display:none;"></span>
                                        <div class="preview-image mb-2">
                                            <img id="ImgPreview" src="{{ asset('img/no-image.jpg') }}" class="img-fluid avatar" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                    <button type="button" id="save" class="btn btn-danger waves-effect waves-light">Save changes</button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="comment">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Tất cả bình luận</h4>
                            </div>
                            <div class="comment-widgets scrollable" style="height:560px;">
                                <!-- Comment Row -->
                                @foreach ($listComment as $key=>$comment)
                                <div class="d-flex flex-row comment-row m-t-0">
                                    <div class="comment-text w-100">
                                        @if (!empty($comment->user))
                                        <h6 class="font-medium">{{ $comment->user->name }} (Học sinh)</h6>
                                        @else
                                        <h6 class="font-medium">{{ $comment->teacher->name }} (Giáo viên)</h6>
                                        @endif

                                        <span class="m-b-15 d-block">{{ $comment->comment }}</span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right">{{ date('d-m-Y', strtotime($comment->created_at)) }}</span>
                                            <span class="action-icons">
                                                <a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
                                            </span>
                                        </div>

                                        <div class="parent_comment" id="comment_{{ $key }}">
                                            @if ($comment->parentComment->count() > 0)
                                                @foreach ($comment->parentComment as $parentComment)
                                                <div class="comment-text w-100">
                                                    @if (!empty($parentComment->user))
                                                    <h6 class="font-medium">{{ $parentComment->user->name }} (Học sinh)</h6>
                                                    @else
                                                    <h6 class="font-medium">{{ $parentComment->teacher->name }} (Giáo viên)</h6>
                                                    @endif
                                                    <span class="m-b-15 d-block">{{ $parentComment->comment }} </span>
                                                    <div class="comment-footer">
                                                        <span class="text-muted float-right">{{ date('d-m-Y', strtotime($parentComment->created_at)) }}</span>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        <div class="card-body border-top">
                                            <div class="row">
                                                <div class="col-11">
                                                    <div class="input-field m-t-0 m-b-0">
                                                        <input type="text" id="reply_comment_{{ $key }}" placeholder="Nhập phản hồi của bạn" class="form-control border-0">
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <button class="btn-circle btn-lg btn-cyan float-right text-white save_comment" data-commentid="{{ $comment->id }}" data-key="{{ $key }}"><i class="fas fa-paper-plane"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <hr />
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection
@push('scripts')
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('webstudent/js/index.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

<script>
    $('.selected').on('click', function(e){
        if($(this).is(':checked')){
            let answerid = $(this).data('answerid');
            let answer = $(this).data('answer');
            $.ajax({
                type: "GET",
                url: "{{ route('update.answer.test') }}",
                data: {
                    answerid:answerid,
                    answer:answer,
                    _token: "{{ csrf_token() }}" },
                success: function (result) {
                },
                error: function (result) {
                }
            });
        }
    });
</script>

<script>

    $('#save').on('click', function(e){
        let id_answer = $('#ans_id').val();
        let image_answer = $('#image_question').val();

        $.ajax({
            type: "GET",
            url: "{{ route('save.image.test') }}",
            data: {
                id_answer: id_answer,
                image_answer: image_answer
            },
            success: function (result) {
                toastr.success("Thêm mới ảnh lời giải thành công");
                $("#responsive-modal").modal('toggle');
            },
            error: function (result) {
            }
        });

    })

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
                let val = $(id_input).val() + '|' + rel;
                $(id_input).val(val);
          },
          error: function(){
          }
      });
    }

</script>

<script>
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
		$('#image2').bind('change', function() {
    		var a = 1;
			var ext = $(this).val().split('.').pop().toLowerCase();
			var picsize = (this.files[0].size);
			if (picsize > 0) {
				if ($.inArray(ext, ['gif','png','jpg','jpeg','svg']) == -1){
					$('#error-image').html('The image is not in the correct format');
				 	$('#error-image').slideDown("slow");
				 	$('.error-image').hide();
				 	$("#image2").val("");
				 	a=0;
				}
				if (picsize > 10000000){
			 		$('#error-image').html('Photos cannot be larger than 10Mb');
			 		$('#error-image').slideDown("slow");
			 		$('.error-image').hide();
			 		$("#image2").val("");
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
	});

    $('.image_ans').on('click', function(e){
        let qn = $(this).data('questionnumber');
        let id = $(this).data('answerid');
        let imageaws = $(this).data('imageans');

        $('#ans_id').val(id);
        $('#title_ans').html('Thêm hình ảnh câu hỏi số ' + qn);
        $('#image_question').val(imageaws);
        $("#responsive-modal").modal();
    });
</script>

<script>
    $('#class_id').on('change', function(e){
        let value = $(this).val();
        $.ajax({
            url: "{{ route('get.test.type') }}",
            type: 'get',
            data: {
                'id':value
            },
            success: function (data) {
                $.each(data, function( index, value ) {
                    console.log( value );
                    let check = '';
                    if(value.id == test_type_id){
                        check = 'selected';
                    }
                    $('#type_test').append("<option value='"+value.id+"' "+check+">"+value.title+"</option>")
                });
            },
            error: function(xhr){
            }
        });
    })
</script>

<script>
    var test_type_id = {{ $detail->test_type_id }};
    $(document).ready(function(){
        let value = $('#type_test').val();
        $.ajax({
            url: "{{ route('get.test.type') }}",
            type: 'get',
            data: {
                'id':value
            },
            success: function (data) {
                $.each(data, function( index, value ) {
                    console.log( value );
                    //check selected
                    let check = '';
                    if(value.id == test_type_id){
                        check = 'selected';
                    }
                    $('#type_test').append("<option value='"+value.id+"' "+check+">"+value.title+"</option>")
                });
            },
            error: function(xhr){
            }
        });
    });
</script>

<script>
    $('.save_comment').on('click', function(e){
        let key = $(this).data('key');
        let comment = $('#reply_comment_' + key).val();
        let commentid = $(this).data('commentid');
        if(comment == '' || comment == null){
            alert('Bạn phải nhập nội dung trước khi trả lời bình luận');
            return false;
        }
        $.ajax({
            type: "GET",
            url: "{{ route('comment.exersire') }}",
            data: {
                ex_id: {{ $detail->id }},
                parent_id: commentid,
                newCmt: comment,
                type:1,
                _token: "{{ csrf_token() }}"
            },
            success: function (result) {
                $('#comment_'+key).append(result);
                $('#reply_comment_' + key).val('');
            },
            error: function (result) {
                $('#reply_comment_' + key).val('');
            }
        });
    });
</script>

@endpush


