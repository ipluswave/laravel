@extends('ajaxmodal')

@section('title')
    修改银行
@endsection

@section('script')
    <script>
        +function() {
            $(document).ready(function() {
                $('#level-form').makeAjaxForm({
                    inModal: true,
                    closeModal: true,
                    submitBtn: '#btn-submit-level'
                });
            });
        }(jQuery);
    </script>
@endsection

@section('footer')
    <button type="button" id="btn-submit-level" class="btn btn-primary blue">修改</button>
@endsection

@section('content')
    {!! Form::open(['route' => ['backend.level.edit.post', 'id' => $model->id], 'method' => 'post', 'role' => 'form', 'id' => 'level-form', 'files' => true]) !!}
        <div class="form-body">
            <div class="form-group">
                <label>Badge</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    {!! Form::text('badge', $model->badge, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>Level</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    {!! Form::text('level', $model->level, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>Level</label>
                <div class="input-group">
                    <!-- <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span> -->
                    {!! Form::file('url_icon','', ['class' => 'form-control']) !!}
                    {!! Form::hidden('url_icon_hidden', $model->url_icon, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('modal')

@endsection