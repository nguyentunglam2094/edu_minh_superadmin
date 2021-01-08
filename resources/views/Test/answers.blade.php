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
                <h3 class="card-title text-center font-weight-bold">Add test</h3>
                <form class="mt-4" method="POST" action="{{ route('add.test') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="test_id" value="{{ $detail->id }}">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        {{-- <div class="row midtext"><h3>Add food</h3></div> --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Choose file pdf</label><br>
                                        <input type="file" name="image" id="image">
                                    </div>
                                    @if ($errors->has('image'))
                                        <span class="text-danger pt-2 error-image">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Title <span class="text-danger">*</span></label>
                                    @if($errors->has('title'))
                                        <input type="text" class="form-control is-invalid"  placeholder="Tiêu đề dạng bài tập" name="title" value="{{ $detail->title }}"  >
                                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                    @else
                                        <input type="text" class="form-control" placeholder="Tiêu đề dạng bài tập" name="title" value="{{ $detail->title }}" >
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Subject <span class="text-danger">*</span></label>
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

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Class <span class="text-danger">*</span></label>
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

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Question number</label>
                                    @if($errors->has('question_number'))
                                        <input type="text" class="form-control is-invalid" placeholder="question number" name="question_number" value="{{ $detail->question_number }}" >
                                        <div class="invalid-feedback">{{ $errors->first('question_number') }}</div>
                                    @else
                                        <input type="text" class="form-control" placeholder="question_number" name="question number" value="{{ $detail->question_number }}" >
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">Minute max</label>
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
                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save and add answers</button>
                    <a href="" class="btn btn-dark">Cancel</a>
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
                                            <div class="title_question">Câu {{ $answers->question_number }}: <a href="">Thêm ảnh lời giải</a></div>
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
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection
@push('scripts')
<script src="js/jquery-3.4.1.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('webstudent/js/index.js') }}"></script>
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
@endpush


