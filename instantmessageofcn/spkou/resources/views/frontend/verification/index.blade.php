@extends('frontend.layouts.default')

@section('title')
{{ trans('member.verification_center') }}
@endsection

@section('description')
    {{ trans('member.verification_center') }}
@endsection

@section('author')
@endsection

@section('header')
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content" style="min-height: 503px;">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <ul class="nav nav-tabs nav-orange" style="float: left;">
                                <li class="active">
                                    <a href="#master-verify" data-toggle="tab" aria-expanded="true"> {{ trans('member.master_verify') }} </a>
                                </li>
                                <li class="">
                                    <a href="#order-verify" data-toggle="tab" aria-expanded="false"> {{ trans('member.order_verify') }} </a>
                                </li>
                                <li class="">
                                    <a href="#security-verify" data-toggle="tab" aria-expanded="false"> {{ trans('member.security_verify') }} </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="master-verify">
                                    <div class="row verify-row">
                                        <div class="col-xs-12 verify-container">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <div class="verify-left">
                                                        <div class="verify-left-icon">
                                                            <img src="/images/icons/verify-user.png" class="img-responsive" />
                                                        </div>
                                                    </div>
                                                    <div class="verify-right">
                                                        <div class="row">
                                                            <div class="col-xs-8 col-md-5">
                                                                {{ trans('member.master_verify') }}
                                                            </div>
                                                            <div class="col-xs-4 col-md-4">
                                                                @if ($_G['user']->is_validated == 1)
                                                                <a href="javascript:;" class="button-verified">
                                                                    {{ trans('member.verified') }}
                                                                </a>
                                                                @else
                                                                <a href="javascript:;" class="button-not-verified">
                                                                    {{ trans('member.not_verified') }}
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="help-block">{{ trans('member.master_verify_hint') }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    @if ($_G['user']->is_validated == 1)
													<a href="javascript:;" class="pull-right" id="reset-master-verify" data-toggle="confirmation" data-original-title="{{ trans('common.are_you_sure') }}" data-btn-ok-label="{{ trans('common.yes') }}" data-btn-ok-icon="icon-like" data-btn-ok-class="btn-success" data-btn-cancel-label="{{ trans('common.no') }}" data-btn-cancel-icon="icon-close" data-btn-cancel-class="btn-danger">{{ trans('member.verify_again') }}</a>
                                                    @else
                                                    <a href="{{ route('frontend.verification.master.verify') }}" class="btn btn-orange pull-right" data-toggle="modal" data-target="#remote-modal">{{ trans('member.verify_now') }}</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row verify-row">
                                        <div class="col-xs-12 verify-container">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <div class="verify-left">
                                                        <div class="verify-left-icon">
                                                            <img src="/images/icons/verify-company.png" class="img-responsive" />
                                                        </div>
                                                    </div>
                                                    <div class="verify-right">
                                                        <div class="row">
                                                            <div class="col-xs-8 col-md-5">
                                                                {{ trans('member.workshop_verify') }}
                                                            </div>
                                                            <div class="col-xs-4 col-md-4">
                                                                <a href="javascript:;" class="button-not-verified">
                                                                    {{ trans('member.not_verified') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="help-block">{{ trans('member.workshop_verify_hint') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <a href="javascript:;" class="btn btn-orange pull-right">{{ trans('member.verify_now') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="order-verify">
                                    <div class="row verify-row">
                                        <div class="col-xs-12 verify-container">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <div class="verify-left">
                                                        <div class="verify-left-icon">
                                                            <img src="/images/icons/verify-user.png" class="img-responsive" />
                                                        </div>
                                                    </div>
                                                    <div class="verify-right">
                                                        <div class="row">
                                                            <div class="col-xs-8 col-md-5">
                                                                {{ trans('member.poster_verify') }}
                                                            </div>
                                                            <div class="col-xs-4 col-md-4">
                                                                <a href="javascript:;" class="button-verified">
                                                                    {{ trans('member.verified') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="help-block">{{ trans('member.poster_verify_hint') }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <a href="javascript:;" class="pull-right">{{ trans('member.verify_again') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row verify-row">
                                        <div class="col-xs-12 verify-container">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <div class="verify-left">
                                                        <div class="verify-left-icon">
                                                            <img src="/images/icons/verify-company.png" class="img-responsive" />
                                                        </div>
                                                    </div>
                                                    <div class="verify-right">
                                                        <div class="row">
                                                            <div class="col-xs-8 col-md-5">
                                                                {{ trans('member.company_verify') }}
                                                            </div>
                                                            <div class="col-xs-4 col-md-4">
                                                                <a href="javascript:;" class="button-not-verified">
                                                                    {{ trans('member.not_verified') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="help-block">{{ trans('member.company_verify_hint') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <a href="javascript:;" class="btn btn-orange pull-right">{{ trans('member.verify_now') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="security-verify">
                                    <div class="row verify-row">
                                        <div class="col-xs-12 verify-container">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <div class="verify-left">
                                                        <div class="verify-left-icon">
                                                            <img src="/images/icons/verify-phone.png" class="img-responsive" />
                                                        </div>
                                                    </div>
                                                    <div class="verify-right">
                                                        <div class="row">
                                                            <div class="col-xs-8 col-md-5">
                                                                {{ trans('member.weixin_verify') }}
                                                            </div>
                                                            <div class="col-xs-4 col-md-4">
                                                                <a href="javascript:;" class="button-verified">
                                                                    {{ trans('member.verified') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="help-block">{{ trans('member.weixin_verify_hint') }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <a href="javascript:;" class="pull-right">{{ trans('member.verify_again') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row verify-row">
                                        <div class="col-xs-12 verify-container">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <div class="verify-left">
                                                        <div class="verify-left-icon">
                                                            <img src="/images/icons/verify-weixin.png" class="img-responsive" />
                                                        </div>
                                                    </div>
                                                    <div class="verify-right">
                                                        <div class="row">
                                                            <div class="col-xs-8 col-md-5">
                                                                {{ trans('member.weixin_verify') }}
                                                            </div>
                                                            <div class="col-xs-4 col-md-4">
                                                                <a href="javascript:;" class="button-not-verified">
                                                                    {{ trans('member.not_verified') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="help-block">{{ trans('member.weixin_verify_hint') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <a href="javascript:;" class="btn btn-orange pull-right">{{ trans('member.verify_now') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row verify-row">
                                        <div class="col-xs-12 verify-container">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <div class="verify-left">
                                                        <div class="verify-left-icon">
                                                            <img src="/images/icons/verify-weibo.png" class="img-responsive" />
                                                        </div>
                                                    </div>
                                                    <div class="verify-right">
                                                        <div class="row">
                                                            <div class="col-xs-8 col-md-5">
                                                                {{ trans('member.weibo_verify') }}
                                                            </div>
                                                            <div class="col-xs-4 col-md-4">
                                                                <a href="javascript:;" class="button-verified">
                                                                    {{ trans('member.verified') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="help-block">{{ trans('member.weibo_verify_hint') }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <a href="javascript:;" class="pull-right">{{ trans('member.verify_again') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row verify-row">
                                        <div class="col-xs-12 verify-container">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <div class="verify-left">
                                                        <div class="verify-left-icon">
                                                            <img src="/images/icons/verify-qq.png" class="img-responsive" />
                                                        </div>
                                                    </div>
                                                    <div class="verify-right">
                                                        <div class="row">
                                                            <div class="col-xs-8 col-md-5">
                                                                {{ trans('member.qq_verify') }}
                                                            </div>
                                                            <div class="col-xs-4 col-md-4">
                                                                <a href="javascript:;" class="button-not-verified">
                                                                    {{ trans('member.not_verified') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <div class="help-block">{{ trans('member.qq_verify_hint') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <a href="javascript:;" class="btn btn-orange pull-right">{{ trans('member.verify_now') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
	<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
    <script>
        +function ($) {
            $(document).ready(function () {
                var loading = false;
                $('#reset-master-verify').on('click', function () {
                    if (loading === false) {
                        $.ajax({
                            url: '{{ route('frontend.verification.master.verfifyagain') }}',
                            method: 'post',
                            dataType: 'json',
                            data: { '_token': '{{ csrf_token() }}' },
                            beforeSend: function () {
                                loading = true;
                            },
                            success: function (resp) {
                                window.location.reload();
                            },
                            error: function (resp) {
                                alertError(resp.msg);
                            },
                            complete: function () {
                                loading = false;
                            }
                        });
                    }
                });
            });
        }(jQuery);
    </script>
@endsection




