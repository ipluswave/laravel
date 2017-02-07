@extends('ajaxmodal')

@section('title')
    修改银行
@endsection

@section('script')
    <script>
        +function() {
            $(document).ready(function() {
                $('#bank-form').makeAjaxForm({
                    inModal: true,
                    closeModal: true,
                    submitBtn: '#btn-submit-bank'
                });

                $('#color-picker-1').ColorPicker({
                    color: '#{{ $model->background_color }}',
                    onShow: function (colpkr) {
                        $(colpkr).fadeIn(500);
                        return false;
                    },
                    onHide: function (colpkr) {
                        $(colpkr).fadeOut(500);
                        return false;
                    },
                    onChange: function (hsb, hex, rgb) {
                        $('#color-picker-1-preview').css('backgroundColor', '#' + hex);
                        $('#color-picker-1').val(hex);
                    }
                });

                $('#color-picker-2').ColorPicker({
                    color: '#{{ $model->font_color }}',
                    onShow: function (colpkr) {
                        $(colpkr).fadeIn(500);
                        return false;
                    },
                    onHide: function (colpkr) {
                        $(colpkr).fadeOut(500);
                        return false;
                    },
                    onChange: function (hsb, hex, rgb) {
                        $('#color-picker-2-preview').css('backgroundColor', '#' + hex);
                        $('#color-picker-2').val(hex);
                    }
                });
            });
        }(jQuery);
    </script>
@endsection

@section('footer')
    <button type="button" id="btn-submit-bank" class="btn btn-primary blue">修改</button>
@endsection

@section('content')
    {!! Form::open(['route' => ['backend.bank.edit.post', 'id' => $model->id], 'method' => 'post', 'role' => 'form', 'id' => 'bank-form', 'files' => true]) !!}
        <div class="form-body">
            <div class="form-group">
                <label>银行名称（中文）</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    {!! Form::text('name_cn', $model->name_cn, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>银行名称（英文）</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    {!! Form::text('name_en', $model->name_en, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>背景颜色</label>
                <div class="input-group">
                    <span class="input-group-addon" id="color-picker-1-preview" style="background-color: #{{ $model->background_color }};">
                        <i class="fa fa-code"></i>
                    </span>
                    {!! Form::text('background_color', $model->background_color, ['class' => 'form-control color-picker', 'id' => 'color-picker-1']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>字体颜色</label>
                <div class="input-group">
                    <span class="input-group-addon" id="color-picker-2-preview" style="background-color: #{{ $model->font_color }};">
                        <i class="fa fa-code"></i>
                    </span>
                    {!! Form::text('font_color', $model->font_color, ['class' => 'form-control color-picker', 'id' => 'color-picker-2']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>标志</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-image"></i>
                    </span>
                    {!! Form::file('logo', ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection

@section('modal')

@endsection