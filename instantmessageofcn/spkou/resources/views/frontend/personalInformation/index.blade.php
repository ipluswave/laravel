@extends('frontend.layouts.default')

@section('title')
Personal Information
@endsection

@section('description')
Personal Information
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/personalInformation.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-blue bold uppercase">{{ trans('common.personal_information') }}</span>
                            </div>
                        </div>
                        <div class="portlet-body personal-info">
                            <div class="portlet-body form">
                                {!! Form::open(['route' => 'frontend.personalinformation.update', 'class' => 'form-horizontal', 'id' => 'personal-form', 'role' => 'form', 'files' => true]) !!}
                                    <div class="form-body">
                                        <div id="personal-form-alert-container">
                                            @include('frontend.flash')
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{ trans('member.real_user_avatar') }}</label>
                                            <div class="col-md-8">
                                                <div class="col-md-3">
                                                    <div class="profile-userpic">
                                                        <img src="{{ $_G['user']->getAvatar() }}" class="img-avatar" alt="" style="width: 100px;height: 100px;">
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <span class="btn blue btn-file">
                                                            <span class="fileinput-new"> {{ trans('member.modify_avatar') }} </span>
                                                            <span class="fileinput-exists"> {{ trans('member.change') }} </span>
                                                            <input type="file" name="avatar"> </span>
                                                        <span class="fileinput-filename"> </span> &nbsp;
                                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                    </div>
                                                    <br/>
                                                    <label class="control-label">{{ trans('member.avatar_image_type') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{ trans('member.gender') }}</label>
                                            <div class="col-md-8">
                                                <div class="md-radio pull-left" style="margin-right: 10px;">
                                                    {!! Form::radio('gender', 0, $_G['user']->gender == 0 ? true : false, ['class' => 'md-radiobtn', 'id' => 'gender-male']) !!}
                                                    <label for="gender-male" style="color: #000;">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> {{ trans('member.male') }}
                                                    </label>
                                                </div>
                                                <div class="md-radio has-error pull-left">
                                                    {!! Form::radio('gender', 1, $_G['user']->gender == 1 ? true : false, ['class' => 'md-radiobtn', 'id' => 'gender-female']) !!}
                                                    <label for="gender-female" style="color: #000;">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> {{ trans('member.female') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{ trans('member.real_name') }}</label>
                                            <div class="col-md-8">
                                                @if ($_G['user']->real_name == 1)
                                                    {!! Form::text('real_name', $_G['user']->real_name, ['class' => "form-control", 'disabled' => 'disabled', 'readonly' => 'readonly']) !!}
                                                @else
                                                    {!! Form::text('real_name', $_G['user']->real_name, ['class' => "form-control"]) !!}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{ trans('member.handphone') }}</label>
                                            <div class="col-md-8">
                                                {!! Form::text('contact_number', $_G['user']->contact_number, ['class' => "form-control", 'disabled' => 'disabled', 'readonly' => 'readonly']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{ trans('member.email') }}</label>
                                            <div class="col-md-8">
                                                {!! Form::text('email_address', $_G['user']->email_address, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{ trans('member.working_place') }}</label>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-4">
                                                        {!! Form::select('province', $provinces, $_G['user']->province_id, ['class' => 'form-control', 'placeholder' => trans('member.province'), 'id' => 'province-selector']) !!}
                                                    </div>
                                                    <div class="col-xs-12 col-md-4">
                                                        @if ($_G['user']->province_id != null)
                                                            {!! Form::select('city', $cities, $_G['user']->city_id, ['class' => 'form-control', 'placeholder' => trans('member.city'), 'id' => 'city-selector']) !!}
                                                        @else
                                                            {!! Form::select('city', $cities, $_G['user']->city_id, ['class' => 'form-control', 'placeholder' => trans('member.city'), 'id' => 'city-selector', 'style' => 'display: none;']) !!}
                                                        @endif
                                                    </div>
                                                    <div class="col-xs-12 col-md-4">
                                                        @if ($_G['user']->city_id != null)
                                                            {!! Form::select('area', $areas, $_G['user']->area_id, ['class' => 'form-control', 'placeholder' => trans('member.area'), 'id' => 'area-selector']) !!}
                                                        @else
                                                            {!! Form::select('area', $areas, $_G['user']->area_id, ['class' => 'form-control', 'placeholder' => trans('member.area'), 'id' => 'area-selector', 'style' => 'display: none;']) !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{ trans('member.introduce_self') }}</label>
                                            <div class="col-md-8">
                                                {!! Form::textarea('introduce_self', $_G['user']->introduce_self, ['class' => 'form-control', 'placeholder' => trans('member.introduce_self')]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <hr>
                                                <button type="button" class="btn blue" id="personal-form-submit-btn">{{ trans('member.save_modify') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
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
    <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    
    <script type="text/javascript">
        +function () {
            $(document).ready(function () {
                $('#personal-form').makeAjaxForm({
                    submitBtn: '#personal-form-submit-btn',
                    successRefresh: true,
                    alertContainer: '#personal-form-alert-container',
                });
                var loading = false;
                $('#province-selector').on('change', function () {
                    if (loading === false) {
                        $('#city-selector').val('');
                        $('#city-selector').hide();
                        $('#area-selector').val('');
                        $('#area-selector').hide();
                        $.ajax({
                            url: '{{ route('frontend.personalinformation.getcity') }}',
                            method: 'get',
                            data: {'province': $('#province-selector').val()},
                            dataType: 'json',
                            beforeSend: function () {
                                loading = true;
                                App.blockUI({
                                    target: $('#personal-form'),
                                    overlayColor: 'none',
                                    centerY: true,
                                    boxed: true
                                });
                                alertClear();
                            },
                            error: function (resp) {
                                alertError(resp);
                            },
                            success: function (resp) {
                                if (resp.status == 'success') {
                                    $('#city-selector').find('option').remove();
                                    $.each(resp.data.city, function (index, value) {
                                        $('#city-selector').append('<option value="' + index + '">' + value + '</option>');
                                    });
                                    if ($('#city-selector').find('option').length) {
                                        $('#city-selector').show();
                                    }
                                } else {
                                    alertError(resp.msg);
                                }
                            },
                            complete: function () {
                                App.unblockUI($('#personal-form'));
                                loading = false;
                            }
                        });
                    }
                });
                $('#city-selector').on('change', function () {
                    if (loading === false) {
                        $('#area-selector').val('');
                        $('#area-selector').hide();
                        $.ajax({
                            url: '{{ route('frontend.personalinformation.getarea') }}',
                            method: 'get',
                            data: {'city': $('#city-selector').val()},
                            dataType: 'json',
                            beforeSend: function () {
                                loading = true;
                                App.blockUI({
                                    target: $('#personal-form'),
                                    overlayColor: 'none',
                                    centerY: true,
                                    boxed: true
                                });
                                alertClear();
                            },
                            error: function (resp) {
                                alertError(resp);
                            },
                            success: function (resp) {
                                if (resp.status == 'success') {
                                    $('#area-selector').find('option').remove();
                                    $.each(resp.data.area, function (index, value) {
                                        $('#area-selector').append('<option value="' + index + '">' + value + '</option>');
                                    });
                                    if ($('#area-selector').find('option').length) {
                                        $('#area-selector').show();
                                    }
                                } else {
                                    alertError(resp.msg);
                                }
                            },
                            complete: function () {
                                App.unblockUI($('#personal-form'));
                                loading = false;
                            }
                        });
                    }
                });
            });
        }(jQuery);
    </script>
@endsection




