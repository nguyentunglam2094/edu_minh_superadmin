@extends('layouts.app1')
@section('title_for_layout','Bình luận')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
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
                        <h2 class="text-center mb-4">Bình luận</h2>
                    </div>

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

@endsection
@push('scripts')
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
                ex_id: {{ $detailEx->id }},
                parent_id: commentid,
                newCmt: comment,
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
