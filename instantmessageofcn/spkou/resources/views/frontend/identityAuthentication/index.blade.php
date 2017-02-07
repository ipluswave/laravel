@extends('frontend.layouts.default')

@section('title')
Identity Authentication
@endsection

@section('description')
Identity Authentication
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/identityAuthentication.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            @include('frontend.flash')
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-blue bold uppercase">{{ trans('common.identity_authentication') }}</span>
                            </div>
                        </div>
                        <div class="portlet-body personal-info">
                            <div class="portlet-body form">
                                <div id="identity-alert-container"></div>
                                @if ($identity && $identity->isPending())
                                    <div class="form-horizontal">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">
                                                    <label class="control-label">
                                                        {{ trans('member.waiting_approval') }}
                                                    </label>
                                                    <br/>
                                                    <a href="{{ route('frontend.identityauthentication.delete') }}" class="btn red-sunglo">{{ trans('member.cancal_approval') }}</a>
                                                    <br/><br/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @if ($identity && $identity->isApproved())
                                        <div class="form-horizontal" id="resubmit-container">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <div class="col-md-12 text-center">
                                                        <div class="checkbox-list">
                                                            <label class="checkbox-inline">
                                                                {{ trans('member.success_authentication') }}
                                                            </label>
                                                        </div>
                                                        <button type="button" class="btn red-sunglo" id="resubmit-identity">{{ trans('member.resubmit_authentication') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {!! Form::open(['route' => ['frontend.identityauthentication.create'], 'id' => 'submit_form', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true, 'style' => $identity && $identity->isApproved() ? 'display: none;' : 'display: block;']) !!}
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{ trans('member.real_name') }}</label>
                                                <div class="col-md-8">
                                                    <input id="real_name" name="real_name" value="{{ $identity ? $identity->real_name : '' }}" type="text" class="form-control" placeholder="{{ trans('member.phd_real_name') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{ trans('member.id_card_no') }}</label>
                                                <div class="col-md-8">
                                                    <input id="id_card_no" name="id_card_no" value="{{ $identity ? $identity->id_card_no : '' }}" type="text" class="form-control" placeholder="{{ trans('member.phd_id_card_no') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{ trans('member.gender') }}</label>
                                                <div class="col-md-9">
                                                    <div class="radio-list">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="gender" id="optionsRadios25" value="0"{{  $identity && $identity->gender == 0 ? ' checked' : '' }}> {{ trans('member.male') }} </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="gender" id="optionsRadios26" value="1"{{ $identity && $identity->gender == 1 ? ' checked' : '' }}> {{ trans('member.female') }} </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{ trans('member.birth_date') }}</label>
                                                <div class="col-md-8">
                                                    <div class="input-group input-medium date date">
                                                        <input id="date_of_birth" name="date_of_birth" value="{{ $identity ? $identity->date_of_birth : '' }}" type="text" class="form-control" readonly>
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{ trans('member.address') }}</label>
                                                <div class="col-md-8">
                                                    <input id="address" name="address" value="{{ $identity ? $identity->address : '' }}"  type="text" class="form-control" placeholder="{{ trans('member.phd_address') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">{{ trans('member.handphone') }}</label>
                                                <div class="col-md-8">
                                                    <input id="handphone_no" name="handphone_no" value="{{ $identity ? $identity->handphone_no : '' }}" type="text" class="form-control" placeholder="{{ trans('member.phd_handphone') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile" class="col-md-3 control-label">{{ trans('member.id_card_upload') }}</label>
                                                <div class="col-md-3">
                                                    <label class="control-label id-card">{{ trans('member.front_id_card') }} </label>
                                                    <br/>
                                                    <div class="fileinput @if($identity && $identity->getIdImageFront() != null) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="/images/no-image-box.png" alt="" /> </div>
                                                        <div class="img_front_id fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                            @if ($identity && $identity->getIdImageFront() != null)
                                                                <img src="{{ $identity->getIdImageFront() }}" alt="" />
                                                            @endif
                                                        </div>
                                                        <div class="text-center">
                                                            <span class="btn blue btn-file">
                                                                <span class="fileinput-new"> {{ trans('member.select_img') }} </span>
                                                                <span class="fileinput-exists"> {{ trans('member.change') }} </span>
                                                                <input type="file" name="id_image_front"> </span>
                                                            <a href="javascript:;" class="btn red-sunglo fileinput-exists" data-dismiss="fileinput"> {{ trans('member.remove') }} </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">

                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label id-card">{{ trans('member.back_id_card') }} </label>
                                                    <br/>
                                                    <div class="fileinput @if($identity && $identity->getIdImageBack() != null) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="/images/no-image-box.png" alt="" /> </div>
                                                        <div class="img_back_id fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                             @if($identity && $identity->getIdImageBack() != null)
                                                                <img src="{{ $identity->getIdImageBack() }}" alt="" />
                                                            @endif
                                                        </div>
                                                        <div class="text-center">
                                                            <span class="btn blue btn-file">
                                                                <span class="fileinput-new"> {{ trans('member.select_img') }} </span>
                                                                <span class="fileinput-exists"> {{ trans('member.change') }} </span>
                                                                <input type="file" name="id_image_back" > </span>
                                                            <a href="javascript:;" class="btn red-sunglo fileinput-exists" data-dismiss="fileinput"> {{ trans('member.remove') }} </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br/><br/><br/>
                                            <div class="form-group">
                                                <div class="col-md-12 text-center">

                                                    <button type="button" class="btn blue" id="identity-submit-btn"><i class="fa fa-check"></i>{{ trans('member.submit_for_approval') }}</button>
                                                    <br/><br/><br/><br/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                </div>
                                            </div>
                                        </div>
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
    <script src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    @if (app()->getLocale() == 'cn')
        <script src="/assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js" type="text/javascript"></script>
    @endif
    <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

    <script src="/custom/js/frontend/identityAuth.js" type="text/javascript"></script>

    <script type="text/javascript">
        +function () {
            $(document).ready(function () {
                $('#submit_form').makeAjaxForm({
                    submitBtn: '#identity-submit-btn',
                    successRefresh: true,
                    alertContainer: '#identity-alert-container',
                    beforeFunction: validate,
                });
            });
        }(jQuery);
    </script>
@endsection




