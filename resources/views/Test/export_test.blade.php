@extends('layouts.app1')
@section('title_for_layout','Thống kê đề thi')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="{{ asset('xtreme/assets/libs/bootstrap-table/dist/bootstrap-table.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <h4 class="text-center mb-4">Thống kê đề thi</h4>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Số lượng học sinh trả lời sai</h4>
                            <table data-toggle="table" data-mobile-responsive="true" class="table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">Câu số</th>
                                        <th width="10%">Số lượng sai</th>
                                        <th>Học sinh sai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail->answers as $answers)
                                    <?php
                                        $title = '';
                                        $questions = $answerList->where('question_number', $answers->question_number)
                                        ->where('answer', '!=', $answers->selected_question);
                                        foreach ($questions as $question) {
                                            if(!empty($question->userTest) && !empty($question->userTest->user)){
                                                $title .= $question->userTest->user->name . ', ';
                                            }
                                        }
                                    ?>
                                    <tr id="tr-id-5" class="tr-class-5">
                                        <td id="td-id-5" class="td-class-5"> Câu {{ $answers->question_number }} </td>
                                        <td>{{ $questions->count() }}</td>
                                        <td>{{ $title }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-4">
                            <h4 class="card-title">Điểm số học sinh (Tổng số HS: {{ $listUserTest->count() }})</h4>
                            <table data-toggle="table" data-mobile-responsive="true" class="table-striped">
                                <thead>
                                    <tr>
                                        <th>Học sinh</th>
                                        <th>Số câu đúng</th>
                                        <th>Điểm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listUserTest as $student)
                                        @if (!empty($student->user))
                                            <?php
                                                $count = (10 * $student->answer_corredt) / $detail->question_number;
                                                $count = round($count, 2);
                                            ?>
                                            <tr id="tr-id-5" class="tr-class-5">
                                                <td id="td-id-5" class="td-class-5"> {{ $student->user->name }} </td>
                                                <td>{{ $student->answer_corredt }}</td>
                                                <td>{{ $count }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="{{ asset('xtreme/assets/libs/bootstrap-table/dist/bootstrap-table.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/bootstrap-table/dist/bootstrap-table-locale-all.min.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/pages/tables/bootstrap-table.init.js') }}"></script>
@endpush
