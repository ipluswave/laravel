@extends('ajaxmodal')

@section('title')
    编辑会员
@endsection

@section('script')
    <script>
        +function() {
            $(document).ready(function() {
                $('#rating-form').makeAjaxForm({
                    inModal: true,
                    closeModal: true,
                    submitBtn: '#btn-submit-rating'
                });
            });
        }(jQuery);
    </script>
@endsection

@section('footer')
    <button type="button" id="btn-submit-rating" class="btn btn-primary blue">编辑</button>
@endsection

@section('content')
    {!! Form::open(['route' => ['backend.user.rating.edit.post', 'id' => $model->id], 'method' => 'post', 'role' => 'form', 'id' => 'rating-form']) !!}
    <div class="form-body">
        <div class="form-group">
            <label><?= trans('member.rate_quality') ?></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                </span>
                {!! Form::number('rate_quality', $model->rate_quality, ['class' => 'form-control']) !!}
            </div>
        </div>
    	<div class="form-group">
            <label><?= trans('member.rate_communicate') ?></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                </span>
                {!! Form::number('rate_communicate', $model->rate_communicate, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label><?= trans('member.rate_speed') ?></label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                </span>
                {!! Form::number('rate_speed', $model->rate_speed, ['class' => 'form-control']) !!}
            </div>
        </div>    
        <div class="form-group">
            <label><?= Lang::get('member.text_review'); ?></label>
            {!! Form::textarea('text_review', $model->text_review, ['class' => 'form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('modal')

@endsection