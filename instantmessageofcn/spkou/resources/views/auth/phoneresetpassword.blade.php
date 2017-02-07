@extends('frontend.layouts.default')

@section('title')
Reset Password
@endsection

@section('description')
    Reset Password
@endsection

@section('author')

@endsection

@section('header')
    <link href="/custom/css/auth/register.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
					<div class="row">
						<div class="col-md-12"><h4 class="caption-subject bold ">{{ trans('member.forget_password') }}</h4></div>
					</div>
					<hr>
                    {!! Form::open(['route' => 'auth.accountchangepassword.phone', 'class' => 'form-horizontal member-form', 'id' => 'forget-form']) !!}
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-icon">
                                    <i class="fa fa-user"></i>
                                    {!! Form::text('contact_number', '', ['class' => 'form-control', 'placeholder' => trans('member.contact_number'), 'id' => 'forget-contact-number']) !!}
                                    <span class="help-block" id="forget-contact-number-invalid-msg">{{ trans('member.contact_number_invalid') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6" style="padding-right: 0;">
                                <div class="input-icon">
                                    <i class="icon-sms"></i>
                                    {!! Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => trans('member.verification_code')]) !!}
                                    <span class="help-block" id="forget-verification-code-empty-msg">{{ trans('member.please_keyin_verification_code') }}</span>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <button id="send-verification-forget" class="btn btn-primary grey" type="button" style="width: 100%;">
                                    {{ trans('member.get_verification_code') }}
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-icon">
                                    <i class="fa fa-lock"></i>
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('member.password')]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-icon">
                                    <i class="fa fa-lock"></i>
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('member.confirm_password')]) !!}
                                    <span class="help-block" id="forget-password-error-msg">{{ trans('member.password_invalid') }}</span>
                                    <span class="help-block" id="forget-password-unmatch-msg">{{ trans('member.password_not_match_confirmation_password') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="button" class="btn blue btn-block" id="submit-forget">
                                    {{ trans('member.change_password') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        +function () {
            $(document).ready(function () {

            });
        }(jQuery);
    </script>
@endsection
