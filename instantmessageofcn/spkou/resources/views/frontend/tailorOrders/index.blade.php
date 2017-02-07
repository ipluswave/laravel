@extends('frontend.layouts.default')

@section('title')
{{ trans('common.tailor_orders') }}
@endsection

@section('description')
{{ trans('common.tailor_orders') }}
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/tailorOrders.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            @include('frontend.flash')
            <!-- BEGIN PAGE BASE CONTENT -->
            @foreach ($orders as $key => $var)
                <div class="portlet box tailor-order">
                    <div class="portlet-title">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="div-title price">
                                    <span class="font-red bold">
                                        ¥{{ $var->pay_price }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="div-title">
                                    {{ trans('member.order_id') }} : {{ $var->order_id }}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="div-title">
                                    {{ trans('member.order_status') }} : <span class="font-red">{{ trans('member.bidding') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3 text-right">
                                <span class="title-profile-image">
                                    <span class="profile-name">{{ $var->creator->nick_name }}</span>
                                    <img alt="" class="img-circle" src="{{ $var->creator->getAvatar() }}" width="35px" height="35px">
                                </span>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-3 column">{{ trans('member.style') }}: {{ $var->style->getTitle() }}</div>
                            <div class="col-md-3 column">{{ trans('member.thickness') }}: {{ $var->explainMaterial() }}</div>
                            <div class="col-md-3 column">{{ trans('member.body_type') }}: {{ $var->explainBodyShape() }}</div>
                            <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}: {{ $var->topBottom->getTitle() }}</div>
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
                        @if ($var->materials->count())
                            <div class="row">
                                <div class="col-md-4 column">{{ trans('member.raw_material') }}：{{ $var->explainRawMaterials() }}</div>
                                <div class="col-md-2"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                            </div>
                        @endif
                    </div>
                    <div class="portlet-footer">
                        <div class="row">
                            <div class="col-md-7 date-time" style="font-size: 13px;">
                                {{ trans('member.complete_time') }} :
                                <span class="bold font-black">{{ $var->planned_date }}</span> &nbsp;&nbsp;
                                ( {{ trans('member.remain') }} <span class="font-red bold counter" data-countdown="{{ $var->planned_date }}">4&nbsp;{{ trans('member.days') }}&nbsp;12&nbsp;{{ trans('member.hours') }}&nbsp;5&nbsp;{{ trans('member.minutes') }}&nbsp;60&nbsp;{{ trans('member.seconds') }}</span> )
                            </div>
                            <div class="col-md-5 text-right">
                            <span class="tailor-action">
                                @if (\Auth::guard('users')->check() && $var->creator_id != \Auth::guard('users')->user()->id)
                                    @if ($var->applicant_id != null)
                                        <span class="font-green01"><i class="fa fa-check-circle"></i></span>
                                        <span class="font-apply">{{ trans('member.already_applied') }},&nbsp;</span><a href="javascript:;" class="link delete-apply" style="padding-top: 10px;" data-applicantid="{{ $var->applicant_id }}">{{ trans('member.cancel_apply') }}</a></span>
                                    @else
                                        <button type="button" class="btn default apply-order" data-orderid="{{ $var->id }}">{{ trans('member.apply_for_order') }}</button>
                                    @endif
                                @endif
                                @if ($var->applicant_id != null && $var->applicant_status == \App\Models\OrderApplicant::STATUS_ACCEPTED)
                                    <a href="{{ route('frontend.order.details', ['id' => $var->id]) }}" class="btn blue" data-toggle="modal" data-target="#remote-modal">{{ trans('member.check_detail') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {!! $orders->render() !!}
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
        @include('frontend.includes.modalTailorOrderCheckDetail')
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
    <script src="/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/jquery-countdown/jquery.countdown.min.js" type="text/javascript"></script>
    <script src="/custom/js/frontend/tailorOrders.js" type="text/javascript"></script>
    <script>
        +function () {
            $(document).ready(function() {
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
                $('body').on('click', '.apply-order', function () {
                    var order_id = $(this).data('orderid');
                    var $this = $(this);
                    $.ajax({
                        url: '{{ route('frontend.order.apply') }}' + '/' + order_id,
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
                                    alertError('{{ trans('order.unable_to_apply_order') }}', true);
                                }
                            } else {
                                alertError('{{ trans('order.unable_to_apply_order') }}', true);
                            }
                            $this.prop('disabled', false);
                        },
                        success: function (resp) {
                            if (resp.status == 'success') {
                                var ct = $this.parent('.tailor-action');

                                //Append the delete apply job button
                                var btn = '<span class="font-green01"><i class="fa fa-check-circle"></i></span>';
                                btn = btn + '<span class="font-apply">{{ trans('member.already_applied') }}, </span>';
                                btn = btn + '<a href="javascript:;" class="link delete-apply" style="padding-top: 10px;" data-applicantid="' + resp.data.applicant_id + '">{{ trans("member.cancel_apply") }}</a>';

                                //Remove the apply job button
                                $this.remove();
                                ct.prepend(btn);
                                alertSuccess('{{ trans('order.successfully_apply_order') }}', true);
                            } else {
                                alertError('{{ trans('order.unable_to_apply_order') }}', true);
                            }
                        }
                    });
                });
            });
        }(jQuery);
    </script>
    <script>
        +function () {
            $(document).ready(function () {

                var elt = $('#advance-filter-tag');
                elt.tagsinput({
                    itemValue: 'value',
                    itemText: 'text',
                });

                function resetFilter() {
                    $('#advance-filter-keyword').val('');
                    $('#advance-filter-keyword').selectpicker('refresh');
                    resetValueFilter();
                }

                function resetValueFilter() {
                    $('#advance-filter-value').find('option').remove();
                    $('#advance-filter-value').selectpicker('refresh');
                }

                function updateFilterValue(data) {
                    var container = $('#advance-filter-value');
                    resetValueFilter();

                    $.each(data, function (index, value) {
                        container.append($('<option></option>')
                                .attr('value', index)
                                .text(value).data('text', value));
                    });
                    container.selectpicker('refresh');
                }

                function addAdvanceFilter() {
                    var keyword_container = $('#advance-filter-keyword');
                    var value_container = $('#advance-filter-value');

                    var keyword = keyword_container.val();
                    var text = keyword_container.find(":selected").text();
                    var valueId = value_container.val();
                    var valueText = value_container.find(":selected").text();

                    if (typeof keyword !== 'undefined' && typeof text !== 'undefined' && typeof valueId !== 'undefined' && typeof valueText !== 'undefined'
                        && keyword != '' && text != '' && valueId != '' && valueText != '') {
                        var obj = [];
                        elt.tagsinput('add', {'value': keyword + '|' + valueId, 'text': text + ':' + valueText});
                        resetFilter();
                    } else {
                        resetFilter();
                    }
                }

                function submitAdvanceFilter() {
                    var base_url = '{!!  $advance_url !!}';
                    var goto_url = base_url + 'advance_filter=' + elt.val();
                    window.location.href = goto_url;
                }

                @if ($advance_filter_json && $advance_filter_json != '')
                    @foreach ($advance_filter_json as $key => $var)
                        elt.tagsinput('add', {'value': '{{ $var['value'] }}', 'text': '{{ $var['text'] }}'});
                    @endforeach
                @endif

                $('body').on('click', '#advance-filter-submit-btn', function () {
                    submitAdvanceFilter();
                });

                $('body').on('change', '#advance-filter-keyword', function () {
                    var id = $(this).val();
                    var text = this.options[this.selectedIndex].innerHTML;

                    if (id != '') {
                        $.ajax({
                            type: 'get',
                            url: '{{ route('frontend.getfiltervalue') }}/' + id,
                            beforeSend: function () {
                            },
                            dataType: 'json',
                            success: function (resp) {
                                if (resp.status === 'success') {
                                    updateFilterValue(resp.data.c);
                                } else {
                                    alertError('{{ trans('common.unknown_error') }}');
                                }
                            },
                            error: function (resp) {
                                alertError('{{ trans('common.unknown_error') }}');
                            }
                        });
                    }
                });

                $('body').on('click', '#advance-filter-add-btn', function () {
                    addAdvanceFilter();
                });
            });
        }(jQuery);
    </script>
@endsection




