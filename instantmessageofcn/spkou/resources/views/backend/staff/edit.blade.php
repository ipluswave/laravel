@extends('ajaxmodal')

@section('title')
    修改操作员
@endsection

@section('script')
    <script>
        +function() {
            $(document).ready(function() {
                $('#staff-form').makeAjaxForm({
                    inModal: true,
                    closeModal: true,
                    submitBtn: '#btn-submit-staff'
                });
            });
        }(jQuery);
    </script>
@endsection

@section('footer')
    <button type="button" id="btn-submit-staff" class="btn btn-primary blue">修改</button>
@endsection

@section('content')
    {!! Form::open(['route' => ['backend.staff.edit.post', 'id' => $model->id], 'method' => 'post', 'role' => 'form', 'id' => 'staff-form']) !!}
    <div class="form-body">
        <div class="form-group">
            <label>登入名</label>
            <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </span>
                {!! Form::text('username', $model->username, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label>电子邮件地址</label>
            <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </span>
                {!! Form::text('email', $model->email, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label>Name</label>
            <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-tag"></i>
                    </span>
                {!! Form::text('name', $model->name, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label>权限组</label>
            <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-users"></i>
                    </span>
                {!! Form::select('permission_group_id', $permissions, $model->permissionGroup ? $model->permissionGroup->id : null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <label>密码</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-key"></i>
                </span>
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            <span class="help-block">如不修改密码请留空</span>
        </div>
        <div class="form-group">
            <label>确认密码</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-key"></i>
                </span>
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
            <span class="help-block">如不修改密码请留空</span>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('modal')

@endsection