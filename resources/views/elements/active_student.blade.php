<div class="col-12-1 bt-switch" style="margin-left:10px">
    @if($data->active == 1)
        <input type="checkbox" data-on-color="primary" data-id="{{ $data->id }}" name="active" data-off-color="info" checked>
    @else
        <input type="checkbox" data-on-color="primary" data-id="{{ $data->id }}" name="active" data-off-color="info">
    @endif
</div>

