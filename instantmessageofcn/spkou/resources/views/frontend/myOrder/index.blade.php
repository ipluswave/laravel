@extends('frontend.layouts.default')

@section('title')
My Order
@endsection

@section('description')
My Order
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/custom/css/frontend/myOrder.css" rel="stylesheet" type="text/css" />
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
                                    <li class="active">{{ trans('member.all') }}</li>
                                    <li>{{ trans('member.apply') }}</li>
                                    <li>{{ trans('member.progressing') }}</li>
                                    <li>{{ trans('member.completed') }}</li>
                                </ul>
                            </div>
                            <div class="caption">
                                <span class="caption-subject font-blue bold uppercase"> {{ trans('common.my_order') }} </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            @foreach ($orders as $key => $var)
                                <div class="portlet box gray-box">
                                    <div class="portlet-title">
                                        <div class="order-status-menu pull-right">
                                            {{ trans('member.need_to_complete_time') }} : {{ $var->planned_date }}
                                            <span class="@if( $var->status == 2)font-red @endif">
                                                ( {{ trans('member.remain') }}&nbsp;<span class="counter" data-countdown="{{ $var->planned_date }}">4&nbsp;{{ trans('member.days') }}&nbsp;12&nbsp;{{ trans('member.hours') }}&nbsp;5&nbsp;{{ trans('member.minutes') }}&nbsp;60&nbsp;{{ trans('member.seconds') }}</span> )
                                            </span>
                                        </div>
                                        <div class="order-id">
                                            {{ trans('member.order_id') }} : {{ $var->order_id }}
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row">
                                            <div class="col-md-3 column">{{ trans('member.style') }}: {{ $var->style ? $var->style->getTitle() : '' }}</div>
                                            <div class="col-md-3 column">{{ trans('member.thickness') }}: {{ $var->explainMaterial() }}</div>
                                            <div class="col-md-3 column">{{ trans('member.body_type') }}: {{ $var->explainBodyShape() }}</div>
                                            <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}: {{ $var->topBottom ? $var->topBottom->getTitle() : '' }}</div>
                                        </div>
                                        @if ($var->seal_width == 1 || $var->decrease_rate == 1)
                                            <div class="row">
                                                @if ($var->seal_width == 1)
                                                    <div class="col-md-3 column">
                                                        {{ $var->explainSealWidth() }}
                                                    </div>
                                                @endif
                                                @if ($var->decrease_rate == 1)
                                                    <div class="col-md-3 column">
                                                        {{ $var->explainDecreaseRate() }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-3 column">
                                                <span class="font-black bold">
                                                    {{ trans('member.quoted_price') }}：
                                                </span>
                                                <span class="font-red bold">
                                                    ¥{{ $var->pay_price }}
                                                </span>
                                            </div>
                                            <div class="col-md-4 column">
                                                <span class="font-black bold">
                                                    {{ trans('member.order_status') }}：
                                                </span>
                                                <span class="font-red bold">
                                                    {{ $var->explainTailorStatus() }}
                                                </span>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                @if ($var->applicant_status == \App\Models\OrderApplicant::STATUS_ACCEPTED)
                                                    <a href="{{ route('frontend.mypublishorderdetails', ['id' => $var->id]) }}" class="btn red-sunglo">{{ trans('member.go_into_working_panel') }}</a>
                                                @elseif( $var->status == \App\Models\OrderApplicant::STATUS_PENDING)
                                                    <a href="javascript:;" class="link delete-apply" style="padding-top: 10px;" data-applicantid="{{ $var->applicant_id }}">{{ trans('member.cancel_apply') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                            <div class="portlet box gray-box" style="display: none;">
                                <div class="portlet-title">
                                    <div class="complete-time pull-right">
                                        {{ trans('member.need_to_complete_time') }} : 2016-10-10 14:30 ( {{ trans('member.remain') }}&nbsp;4&nbsp;{{ trans('member.days') }}&nbsp;12&nbsp;{{ trans('member.hours') }}&nbsp;5&nbsp;{{ trans('member.minutes') }}&nbsp;60&nbsp;{{ trans('member.seconds') }} )
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
                                        <div class="col-md-3 column">
                                            <span class="font-black bold">
                                            {{ trans('member.order_status') }}：
                                            </span>
                                            <span class="font-red bold">
                                            {{ trans('member.apply') }}
                                            </span>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn blue">{{ trans('member.check_detail') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet box gray-box" style="display: none;">
                                <div class="portlet-title">
                                    <div class="complete-time pull-right">
                                        {{ trans('member.need_to_complete_time') }} : 2016-10-10 14:30 <span class="font-red">( {{ trans('member.remain') }}&nbsp;4&nbsp;{{ trans('member.days') }}&nbsp;12&nbsp;{{ trans('member.hours') }}&nbsp;5&nbsp;{{ trans('member.minutes') }}&nbsp;60&nbsp;{{ trans('member.seconds') }} )</span>
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
                                        <div class="col-md-3 column">
                                            <span class="font-black bold">
                                            {{ trans('member.order_status') }}：
                                            </span>
                                            <span class="font-red bold">
                                            {{ trans('member.progressing') }}
                                            </span>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn red-sunglo">{{ trans('member.cancel_apply') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet box gray-box" style="display: none;">
                                <div class="portlet-title">
                                    <div class="complete-time pull-right">
                                        {{ trans('member.need_to_complete_time') }} : 2016-10-10 14:30 ( {{ trans('member.remain') }}&nbsp;4&nbsp;{{ trans('member.days') }}&nbsp;12&nbsp;{{ trans('member.hours') }}&nbsp;5&nbsp;{{ trans('member.minutes') }}&nbsp;60&nbsp;{{ trans('member.seconds') }} )
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
                                        <div class="col-md-3 column">
                                            <span class="font-black bold">
                                            {{ trans('member.order_status') }}：
                                            </span>
                                            <span class="bold">
                                            {{ trans('member.reject') }}
                                            </span>
                                        </div>
                                        <div class="col-md-4 font-red text-right delete-info">
                                            {{ trans('member.delete_after_24h') }}
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn blue">{{ trans('member.delete_order') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet box gray-box" style="display: none;">
                                <div class="portlet-title">
                                    <div class="complete-time pull-right">
                                        {{ trans('member.need_to_complete_time') }} : 2016-10-10 14:30 ( {{ trans('member.remain') }}&nbsp;4&nbsp;{{ trans('member.days') }}&nbsp;12&nbsp;{{ trans('member.hours') }}&nbsp;5&nbsp;{{ trans('member.minutes') }}&nbsp;60&nbsp;{{ trans('member.seconds') }} )
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
                                        <div class="col-md-3 column">
                                            <span class="font-black bold">
                                            {{ trans('member.order_status') }}：
                                            </span>
                                            <span class="bold">
                                            {{ trans('member.completed') }}
                                            </span>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn blue">{{ trans('member.delete_order') }}</button>
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
    </div>
    <!-- END CONTENT -->
	        
@endsection


@section('footer')
    <script src="/assets/global/plugins/jquery-countdown/jquery.countdown.min.js" type="text/javascript"></script>
    <script src="/custom/js/frontend/myOrders.js" type="text/javascript"></script>
    <script>
        +function () {
            $(document).ready(function () {
                $('span.counter').each (function (index, value) {
                    $(this).countdown($(this).data('countdown'), function(event) {
                        $(this).html(
                            event.strftime('%D {{ trans('member.days') }} %H {{ trans('member.hours') }} %M {{ trans('member.minutes') }} %S {{ trans('member.seconds') }}')
                        );
                    });
                });
                $('body').on('click', '.delete-apply', function () {
                    var applicant_id = $(this).data('applicantid');
                    var $this = $(this);
                    $.ajax({
                        url: '{{ route('frontend.order.applydelete') }}' + '/' + applicant_id,
                        dataType: 'json',
                        data: {'_token': '{!! csrf_token() !!}'},
                        method: 'post',
                        beforeSend: function () {
                            $this.prop('disabled', true);
                        },
                        error: function (response, statusText, xhr, formElm) {
                            if (typeof response !== 'undefined' && typeof response.status !== 'undefined' && typeof response.responseText !== 'undefined' && typeof response.responseJSON !== 'undefined') {
                                if (response.status == 422) {
                                    $.each(response.responseJSON, function(i) {
                                        $.each(response.responseJSON[i], function(key, value) {
                                            alertError(value, false);
                                        });
                                    });
                                } else {
                                    alertError('{{ trans('order.unable_to_delete_apply') }}', true);
                                }
                            } else {
                                alertError('{{ trans('order.unable_to_delete_apply') }}', true);
                            }
                            $this.prop('disabled', false);
                        },
                        success: function (resp) {
                            if (resp.status == 'success') {
                                var ct = $this.parent('.tailor-action');

                                //Append the delete apply job button
                                var btn = '<button type="button" class="btn default apply-order" data-orderid="' + resp.data.order_id + '">{{ trans('member.apply_for_order') }}</button>';

                                //Remove the delete apply button
                                ct.find('span.font-green01').remove();
                                ct.find('span.font-apply').remove();
                                ct.find('a.delete-apply').remove();

                                ct.prepend(btn);
                                alertSuccess('{{ trans('order.successfully_delete_apply') }}', true);
                            } else {
                                alertError('{{ trans('order.unable_to_delete_apply') }}', true);
                            }
                        }
                    });
                });
            });
        }(jQuery);
    </script>
@endsection




