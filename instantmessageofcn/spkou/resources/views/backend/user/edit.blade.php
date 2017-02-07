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
    {!! Form::open(['route' => ['backend.user.edit.post', 'id' => $model->id], 'method' => 'post', 'role' => 'form', 'id' => 'user-form']) !!}
    <div class="form-body">
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
            <label>密码</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-key"></i>
                </span>
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            <span class="help-block">如不更改密码请留空</span>
        </div>
        <div class="form-group">
            <label>确认密码</label>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-key"></i>
                </span>
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            </div>
            <span class="help-block">如不更改密码请留空</span>
        </div>
        <div class="form-group">
	            <label><?= Lang::get('member.real_name'); ?></label>
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <i class="fa fa-user"></i>
	                </span>
	                {!! Form::text('real_name', $model->real_name, ['class' => 'form-control']) !!}
	            </div>
	        </div>
	        <div class="form-group">
	            <label><?= Lang::get('member.birth_date'); ?></label>
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <i class="fa fa-birthday-cake"></i>
	                </span>
	                {!! Form::date('birth_date', $model->date_of_birth, ['class' => 'form-control']) !!}
	            </div>
	        </div>
	        <div class="form-group">
	            <label><?= Lang::get('member.work_experience'); ?></label>
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <i class="fa fa-user-plus"></i>
	                </span>
	                {!! Form::text('work_experience', $model->experience, [
	                	'class' => 'form-control', 
	                	'onkeypress' => 'if (event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)) {return false;}',
	                	'maxlength' => 2
	                ]) !!}
	            </div>
	        </div>
	        <div class="form-group">
	            <label><?= Lang::get('member.handphone'); ?></label>
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <i class="fa fa-phone"></i>
	                </span>
	                {!! Form::text('handphone', $model->handphone_no, ['class' => 'form-control']) !!}
	            </div>
	        </div>
	        <div class="form-group">
	            <label><?= Lang::get('member.address'); ?></label>
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <i class="fa fa-home"></i>
	                </span>
	                {!! Form::text('address', $model->address, ['class' => 'form-control']) !!}
	            </div>
	        </div>
	        <div class="form-group">
	            <label><?= Lang::get('member.gender'); ?></label>
	            <div class="input-group">
	                {!! Form::radio('gender', 0, !(boolean) $model->gender) !!}<?= Lang::get('member.male'); ?>
	                {!! Form::radio('gender', 1, (boolean) $model->gender) !!}<?= Lang::get('member.female'); ?>
	            </div>
	        </div>
	        <div class="form-group">
	            <label><?= Lang::get('member.comment_rating'); ?></label>
                {!! Form::textarea('comment_rating', $model->comment_rating, ['class' => 'form-control']) !!}
	        </div>
	        <div class="form-group">
	            <label><?= Lang::get('member.account_balance'); ?></label>
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <i class="fa fa-money"></i>
	                </span>
	                {!! Form::text('account_balance', $model->account_balance, [
	                	'class' => 'form-control', 
	                	'onkeypress' => 'if (event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)) {return false;}',
	                	'maxlength' => 11
	                ]) !!}
	            </div>
	        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('modal')

@endsection