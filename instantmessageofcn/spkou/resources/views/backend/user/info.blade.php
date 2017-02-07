@extends('ajaxmodal')

@section('title')
    编辑会员
@endsection

@section('script')
    <script>
        +function() {
            $(document).ready(function() {
                $('#user-form').makeAjaxForm({
                    inModal: true,
                    closeModal: true,
                    submitBtn: '#btn-submit-user'
                });
            });
        }(jQuery);
    </script>
@endsection

@section('footer')
    <button type="button" id="btn-submit-user" class="btn btn-primary blue">编辑</button>
@endsection

@section('content')
    <div class="form-body">
        <div class="form-group">
            <label>评分: </label>
            <span><?= $rating ?></span>
        </div>
        <div class="form-group">
            <label>水平: </label>
            <span><?= $level ?></span>
        </div>
    </div>
@endsection

@section('modal')

@endsection