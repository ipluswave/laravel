@extends('ajaxmodal')

@section('title')@endsection

@section('footer')
    <button type="button" id="btn-submit" class="btn btn-primary">更新</button>
@endsection

@section('script')
    <script>
        +function() {
            $(document).ready(function() {
                $('.ajaxform').makeAjaxForm({
                    closeModal: true,
                    inModal: true,
                    submitBtn: '#btn-submit',
                });
            });
        }(jQuery);
    </script>
@endsection

@section('content')
    {!! Form::open(['method' => 'post', 'id' => 'profile-form', 'class' => 'ajaxform']) !!}
         <div class="form-body">
             <div class="form-group">
                 <label class="control-label">当前密码</label>
                 {!! Form::password('current_password', ['class' => 'form-control']) !!}
             </div>
             <div class="form-group">
                 <label class="control-label">新密码</label>
                 {!! Form::password('new_password', ['class' => 'form-control']) !!}
                 <span class="help-block">如不修改密码请留空</span>
             </div>
             <div class="form-group">
                 <label class="control-label">新密码确认</label>
                 {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
                 <span class="help-block">如不修改密码请留空</span>
             </div>
         </div>
    {!! Form::close() !!}
@endsection