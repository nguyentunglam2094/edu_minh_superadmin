<div class="comment-text w-100">
    @if (!empty($comment->user))
    <h6 class="font-medium">{{ $comment->user->name }} (Học sinh)</h6>
    @else
    <h6 class="font-medium">{{ $comment->teacher->name }} (Giáo viên)</h6>
    @endif
    <span class="m-b-15 d-block">{{ $comment->comment }} </span>
    <div class="comment-footer">
        <span class="text-muted float-right">{{ date('d-m-Y', strtotime($comment->created_at)) }}</span>
    </div>
</div>
