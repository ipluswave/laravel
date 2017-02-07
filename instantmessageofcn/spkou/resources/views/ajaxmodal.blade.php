<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">@section('title')@show</h4>
</div>
<div class="modal-body">
    <div class="modal-alert-container"></div>
    @section('content')@show
</div>
<div class="modal-footer">
    @section('footer')@show
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
@section('script')@show