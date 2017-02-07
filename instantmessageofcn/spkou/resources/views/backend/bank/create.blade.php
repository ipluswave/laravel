@extends('ajaxmodal')

@section('title')
    新增银行
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
                    color: '#ffffff',
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
                    color: '#000',
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
    <button type="button" id="btn-submit-bank" class="btn btn-primary blue">新增</button>
@endsection

@section('content')
    {!! Form::open(['route' => ['backend.bank.create.post'], 'method' => 'post', 'role' => 'form', 'id' => 'bank-form', 'files' => true]) !!}
        <div class="form-body">
            <div class="form-group">
                <label>银行名称（中文）</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    {!! Form::text('name_cn', '', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>银行名称（英文）</label>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-building"></i>
                    </span>
                    {!! Form::text('name_en', '', ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>背景颜色</label>
                <div class="input-group">
                    <span class="input-group-addon" id="color-picker-1-preview">
                        <i class="fa fa-code"></i>
                    </span>
                    {!! Form::text('background_color', '', ['class' => 'form-control color-picker', 'id' => 'color-picker-1']) !!}
                </div>
            </div>
            <div class="form-group">
                <label>字体颜色</label>
                <div class="input-group">
                    <span class="input-group-addon" id="color-picker-2-preview">
                        <i class="fa fa-code"></i>
                    </span>
                    {!! Form::text('font_color', '', ['class' => 'form-control color-picker', 'id' => 'color-picker-2']) !!}
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