@extends('layouts.app1')
@section('title_for_layout','Thêm dạng bài tập')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/xtreme/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.date.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/pickadate/lib/themes/default.time.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('xtreme/assets/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/ckeditor/samples/css/samples.css') }}">

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

@endsection
@section('bread')

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center font-weight-bold">Loại đề thi</h3>
                    <form class="mt-4" method="POST" action="{{ route('store.test.type') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- <div class="row midtext"><h3>Add food</h3></div> --}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Tiêu đề <span class="text-danger">*</span></label>
                                @if($errors->has('title'))
                                    <input type="text" class="form-control is-invalid"  placeholder="Loại đề thi" name="title" value="{{ old('title') }}"  >
                                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                @else
                                    <input type="text" class="form-control" placeholder="Loại đề thi" name="title" value="{{ old('title') }}" >
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


</script>

@endpush


