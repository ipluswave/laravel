@extends('frontend.layouts.default')

@section('title')
My Publish Order
@endsection

@section('description')
My Publish Order
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-star-rating/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/myPublishOrder.css" rel="stylesheet" type="text/css" />
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
                            <div class="order-status-menu pull-right">
                                <ul>
                                    <li class="{{ !$request->has('status') ? 'active' : '' }}">
                                        <a href="{{ route('frontend.mypublishorder') }}">{{ trans('member.all') }}</a>
                                    </li>
                                    <li class="{{ $request->has('status') && $request->get('status') == 0 ? 'active' : '' }}">
                                        <a href="{{ route('frontend.mypublishorder', ['status' => \App\Models\Order::STATUS_DRAFT]) }}">{{ trans('member.pending') }}</a>
                                    </li>
                                    <li class="{{ $request->has('status') && $request->get('status') == 1 ? 'active' : '' }}">
                                        <a href="{{ route('frontend.mypublishorder', ['status' => \App\Models\Order::STATUS_PUBLISHED]) }}">{{ trans('member.publish') }}</a>
                                    </li>
                                    <li class="{{ $request->has('status') && $request->get('status') == 2 ? 'active' : '' }}">
                                        <a href="{{ route('frontend.mypublishorder', ['status' => \App\Models\Order::STATUS_HIRED]) }}">{{ trans('member.progressing') }}</a>
                                    </li>
                                    <li class="{{ $request->has('status') && $request->get('status') == 3 ? 'active' : '' }}">
                                        <a href="{{ route('frontend.mypublishorder', ['status' => \App\Models\Order::STATUS_COMPLETED]) }}">{{ trans('member.completed') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="caption">
                                <span class="caption-subject font-blue bold uppercase">{{ trans('common.my_publish_order') }}</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            @include('frontend.includes.orderDetails', ['orders' => $myOrder, 'operation' => true])
                            <div class="portlet box gray-box" style="display: none;">
                                <div class="portlet-title">
                                    <div class="complete-time pull-right">
                                        {{ trans('member.complete_time') }} : 2016-10-10 14:30
                                    </div>
                                    <div class="order-id">
                                        {{ trans('member.order_id') }} : NGC201354251456
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.style') }}：男装</div>
                                        <div class="col-md-3 column">{{ trans('member.thickness') }}：厚</div>
                                        <div class="col-md-3 column">{{ trans('member.body_type') }}：亚洲</div>
                                        <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}：正装大衣</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.seam_width') }}：合缝1cm</div>
                                        <div class="col-md-3 column">{{ trans('member.shrinkage') }}：径向50%</div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 column">{{ trans('member.raw_material') }}：梭织 80%棉花 60%涤纶</div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 column">
                                            <span class="font-black bold">
                                            {{ trans('member.quoted_price') }}：
                                            </span>
                                            <span class="font-red bold">
                                            ¥5，266
                                            </span>
                                        </div>
                                        <div class="col-md-4 column">
                                            <span class="font-black bold">
                                            {{ trans('member.order_status') }}：
                                            </span>
                                            <span class="font-red bold">
                                            {{ trans('member.pending') }}
                                            </span>
                                        </div>
                                        <div class="col-md-5 text-right">
                                            <a href="javascript:;" class="link" style="padding-top: 10px;">{{ trans('member.delete') }}</a>
                                            <button type="submit" class="btn blue">{{ trans('member.continue_editing') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet box gray-box" style="display: none;">
                                <div class="portlet-title">
                                    <div class="complete-time pull-right">
                                        {{ trans('member.complete_time') }} : 2016-10-10 14:30
                                    </div>
                                    <div class="order-id">
                                        {{ trans('member.order_id') }} : NGC201354251456
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.style') }}：男装</div>
                                        <div class="col-md-3 column">{{ trans('member.thickness') }}：厚</div>
                                        <div class="col-md-3 column">{{ trans('member.body_type') }}：亚洲</div>
                                        <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}：正装大衣</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.seam_width') }}：合缝1cm</div>
                                        <div class="col-md-3 column">{{ trans('member.shrinkage') }}：径向50%</div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 column">{{ trans('member.raw_material') }}：梭织 80%棉花 60%涤纶</div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 column">
                                            <span class="font-black bold">
                                            {{ trans('member.quoted_price') }}：
                                            </span>
                                            <span class="font-red bold">
                                            ¥5，266
                                            </span>
                                        </div>
                                        <div class="col-md-4 column">
                                            <span class="font-black bold">
                                            {{ trans('member.order_status') }}：
                                            </span>
                                            <span class="font-red bold">
                                            {{ trans('member.publish') }}， 50{{ trans('member.applicant') }}
                                            </span>
                                        </div>
                                        <div class="col-md-5 text-right">
                                            <a href="javascript:;" class="link" style="padding-top: 10px;">{{ trans('member.delete') }}</a>
                                            <button type="submit" class="btn blue">{{ trans('member.view_application') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet box gray-box" style="display: none;">
                                <div class="portlet-title">
                                    <div class="complete-time pull-right">
                                        {{ trans('member.complete_time') }} : 2016-10-10 14:30
                                    </div>
                                    <div class="order-id">
                                        {{ trans('member.order_id') }} : NGC201354251456
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.style') }}：男装</div>
                                        <div class="col-md-3 column">{{ trans('member.thickness') }}：厚</div>
                                        <div class="col-md-3 column">{{ trans('member.body_type') }}：亚洲</div>
                                        <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}：正装大衣</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.seam_width') }}：合缝1cm</div>
                                        <div class="col-md-3 column">{{ trans('member.shrinkage') }}：径向50%</div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 column">{{ trans('member.raw_material') }}：梭织 80%棉花 60%涤纶</div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 column">
                                            <span class="font-black bold">
                                            {{ trans('member.quoted_price') }}：
                                            </span>
                                            <span class="font-red bold">
                                            ¥5，266
                                            </span>
                                        </div>
                                        <div class="col-md-4 column">
                                            <span class="font-black bold">
                                            {{ trans('member.order_status') }}：
                                            </span>
                                            <span class="bold font-red">
                                            {{ trans('member.progressing') }}
                                            </span>
                                        </div>
                                        <div class="col-md-5 text-right">
                                            <a href="javascript:;" class="link" style="padding-top: 10px;">{{ trans('member.go_into_working_panel') }}</a>
                                            <button type="submit" class="btn red-sunglo">{{ trans('member.confirm_completion') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet box gray-box" style="display: none;">
                                <div class="portlet-title">
                                    <div class="complete-time pull-right">
                                        {{ trans('member.complete_time') }} : 2016-10-10 14:30
                                    </div>
                                    <div class="order-id">
                                        {{ trans('member.order_id') }} : NGC201354251456
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.style') }}：男装</div>
                                        <div class="col-md-3 column">{{ trans('member.thickness') }}：厚</div>
                                        <div class="col-md-3 column">{{ trans('member.body_type') }}：亚洲</div>
                                        <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}：正装大衣</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.seam_width') }}：合缝1cm</div>
                                        <div class="col-md-3 column">{{ trans('member.shrinkage') }}：径向50%</div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 column">{{ trans('member.raw_material') }}：梭织 80%棉花 60%涤纶</div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 column">
                                            <span class="font-black bold">
                                            {{ trans('member.quoted_price') }}：
                                            </span>
                                            <span class="font-red bold">
                                            ¥5，266
                                            </span>
                                        </div>
                                        <div class="col-md-4 column">
                                            <span class="font-black bold">
                                            {{ trans('member.order_status') }}：
                                            </span>
                                            <span class="bold">
                                            {{ trans('member.completed') }}
                                            </span>
                                        </div>
                                        <div class="col-md-5 text-right">
                                            <a href="javascript:;" class="link" style="padding-top: 10px;">{{ trans('member.view') }}</a>
                                            <button type="submit" class="btn blue" data-toggle="modal" data-target="#modalEvaluationOrder">&nbsp;　{{ trans('member.evaluation') }}　&nbsp;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet box gray-box" style="display: none;">
                                <div class="portlet-title">
                                    <div class="complete-time pull-right">
                                        {{ trans('member.complete_time') }} : 2016-10-10 14:30
                                    </div>
                                    <div class="order-id">
                                        {{ trans('member.order_id') }} : NGC201354251456
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.style') }}：男装</div>
                                        <div class="col-md-3 column">{{ trans('member.thickness') }}：厚</div>
                                        <div class="col-md-3 column">{{ trans('member.body_type') }}：亚洲</div>
                                        <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}：正装大衣</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 column">{{ trans('member.seam_width') }}：合缝1cm</div>
                                        <div class="col-md-3 column">{{ trans('member.shrinkage') }}：径向50%</div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 column">{{ trans('member.raw_material') }}：梭织 80%棉花 60%涤纶</div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 column">
                                            <span class="font-black bold">
                                            {{ trans('member.quoted_price') }}：
                                            </span>
                                            <span class="font-red bold">
                                            ¥5，266
                                            </span>
                                        </div>
                                        <div class="col-md-4 column">
                                            <span class="font-black bold">
                                            {{ trans('member.order_status') }}：
                                            </span>
                                            <span class="font-red bold">
                                            {{ trans('member.publish') }}， 50{{ trans('member.applicant') }}
                                            </span>
                                        </div>
                                        <div class="col-md-5 text-right">
                                            <a href="javascript:;" class="link" style="padding-top: 10px;">{{ trans('member.delete') }}</a>
                                            <a href="javascript:;" class="link" style="padding-top: 10px;">{{ trans('member.continue_editing') }}</a>
                                            <button type="submit" class="btn blue">&nbsp;　{{ trans('member.hide') }}　&nbsp;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
        @include('frontend.includes.modalCreateExtraSize')
        @include('frontend.includes.modalEvaluationOrder')
    </div>
    <!-- END CONTENT -->
@endsection

@section('footer')
    <script src="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-star-rating/js/star-rating.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
    <script src="/custom/js/frontend/myPublishOrder.js" type="text/javascript"></script>
    <script>
        +function () {
            $(document).ready(function () {
                $('body').on('click', '.select-tailor', function () {
                    var applicant_id = $(this).data('applicantid');
                    var $this = $(this);
                    $.ajax({
                        url: '{{ route('frontend.applicant.approve') }}/' + applicant_id,
                        dataType: 'json',
                        method: 'post',
                        data: {'_token': '{{ csrf_token() }}'},
                        beforeSend: function () {
                            $this.prop('disabled', true);
                        },
                        error: function (response, statusText, xhr, formElm) {
                            if (typeof response !== 'undefined' && typeof response.status !== 'undefined' && typeof response.responseText !== 'undefined' && typeof response.responseJSON !== 'undefined') {
                                if (response.status == 422) {
                                    $.each(response.responseJSON, function (i) {
                                        $.each(response.responseJSON[i], function (key, value) {
                                            alertError(value, false);
                                        });
                                    });
                                } else {
                                    alertError('{{ trans('common.unknown_error') }}', true);
                                }
                            } else {
                                alertError('{{ trans('common.unknown_error') }}', true);
                            }
                        },
                        success: function (resp) {
                            if (typeof resp !== 'undefined' && typeof resp.status !== 'undefined' && resp.status == 'success') {
                                window.location.reload();
                            } else {
                                alertError('{{ trans('common.unknown_error') }}');
                            }
                        }
                    });
                });
            });
        }(jQuery);
    </script>
@endsection




