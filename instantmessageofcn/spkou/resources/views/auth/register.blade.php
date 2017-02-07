@extends('frontend.layouts.default')

@section('title')
Register
@endsection

@section('description')
Register
@endsection

@section('author')
vika
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
						<div class="col-md-12"><h4 class="caption-subject bold ">{{ trans('member.register_spkou_member') }}</h4></div>
					</div>
					<hr>
                    {!! Form::open(['route' => 'register.post', 'class' => 'form-horizontal member-form', 'id' => 'register-form']) !!}
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-icon">
                                    <i class="fa fa-user"></i>
                                    {!! Form::text('contact_number', '', ['class' => 'form-control', 'placeholder' => trans('member.contact_number'), 'id' => 'register-contact-number']) !!}
                                    <span class="help-block" id="contact-number-invalid-msg">{{ trans('member.contact_number_invalid') }}</span>
                                    <span class="help-block" id="contact-number-registered-msg">{{ trans('member.contact_number_registered') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6" style="padding-right: 0;">
                                <div class="input-icon">
                                    <i class="icon-sms"></i>
                                    {!! Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => trans('member.verification_code')]) !!}
                                    <span class="help-block" id="verification-code-empty-msg">{{ trans('member.please_keyin_verification_code') }}</span>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <button id="send-verification-register" class="btn btn-primary grey" type="button" style="width: 100%;">
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
                                    <span class="help-block" id="password-error-msg">{{ trans('member.password_invalid') }}</span>
                                    <span class="help-block" id="password-unmatch-msg">{{ trans('member.password_not_match_confirmation_password') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <h5>
                                    <input type="checkbox" name="accept_tnc" value="1"> {{ trans('member.i_accept') }}<span style="color:blue">{{ trans('member.terms_and_conditions') }}</span>{{ trans('member.and') }}<span style="color:blue">{{ trans('member.privacy_policy') }}</span>
                                </h5>
                                <span class="help-block" id="tnc-error-msg">{{ trans('member.please_accept_tnc') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                @if (isset($qqLogin) && $qqLogin === true)
                                    <input type="hidden" name="qq_open_id" value="{{ $oauthUser->id }}" />
                                    <input type="hidden" name="qqlogin" value="1" />
                                @endif

                                @if (isset($weiboLogin) && $weiboLogin === true)
                                    <input type="hidden" name="weibo_open_id" value="{{ $oauthUser->id }}" />
                                    <input type="hidden" name="weibologin" value="1" />
                                @endif

                                @if (isset($weixinLogin) && $weixinLogin === true)
                                    <input type="hidden" name="weixin_open_id" value="{{ $oauthUser->id }}" />
                                    <input type="hidden" name="weixinlogin" value="1" />
                                @endif
                                <button type="button" class="btn blue btn-block" id="submit-register">
                                    {{ trans('member.register_now') }}
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
