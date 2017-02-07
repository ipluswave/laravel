@extends('frontend.layouts.default')

@section('title')
Reset Password
@endsection

@section('description')
Reset Password
@endsection

@section('author')
vika
@endsection

@section('header')
@endsection

<!-- Main Content -->
@section('content')
<div class="container" style="height: 400px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
						<div class="col-md-12"><h4 class="caption-subject bold ">{{ trans('member.forget_password') }}</h4></div>
					</div>
					<hr>
					@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    {!! Form::open(['route' => 'password.reset.post', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form']) !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-6 col-md-offset-3">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('member.email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--
                        Apply at last state of project
                        <div class="form-group">
                            <div class="col-md-3 col-md-offset-3">
                                <input type="text" class="form-control" name="verification_code" placeholder="{{ trans('member.verification_code') }}">
                            </div>
                            <div class="col-md-3">
                                <label style="background-color: #c2cad8; padding:8px 32px;">{{ trans('member.get_verification_code') }} ( 0 / 3 )</label>
                            </div>
                        </div>
                        -->
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-3">--}}
                                {{--<input type="password" class="form-control" name="password" placeholder="{{ trans('member.new_password') }}">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-3">--}}
                                {{--<input type="password" class="form-control" name="confirm_password" placeholder="{{ trans('member.confirm_new_password') }}">--}}
                            {{--</div>--}}
                        {{--</div>--}}
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="col-md-12 btn btn-primary">
                                    {{ trans('member.reset_password') }}
                                </button>
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
@endsection