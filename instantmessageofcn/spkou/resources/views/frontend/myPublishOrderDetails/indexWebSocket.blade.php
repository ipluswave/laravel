@extends('frontend.layouts.default')

@section('title')
My Publish Order Details
@endsection

@section('description')
My Publish Order Details
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css" rel="stylesheet" type="text/css" />
    <link href="/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/myPublishOrderDetails.css" rel="stylesheet" type="text/css" />
    <link href="/custom/css/frontend/myChat.css" rel="stylesheet" type="text/css" />
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
                                <span class="caption-subject font-blue bold uppercase">{{ trans('common.my_publish_order') }} > <span style="color:#000000">{{ trans('member.progressing_order') }}</span></span>
                            </div>
                        </div>
                        <div class="portlet-body new-order">
                            <div class="gray-box">
                                <div class="complete-time pull-right">
                                    {{ trans('member.complete_time') }} : {{ $order->planned_date }}
                                </div>
                                <div class="order-id">
                                    {{ trans('member.order_id') }} : {{ $order->order_id }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 column">{{ trans('member.style') }}: {{ $order->style->getTitle() }}</div>
                                <div class="col-md-3 column">{{ trans('member.thickness') }}: {{ $order->explainMaterial() }}</div>
                                <div class="col-md-3 column">{{ trans('member.body_type') }}: {{ $order->explainBodyShape() }}</div>
                                <div class="col-md-3 column">{{ trans('member.top_bottom_clothes') }}: {{ $order->topBottom->getTitle() }}</div>
                            </div>
                            @if ($order->seal_width == 1 || $order->decrease_rate == 1 || $order->materials->count())
                                <div class="row">
                                    @if ($order->seal_width == 1)
                                        <div class="col-md-3 column">
                                            {{ $order->explainSealWidth() }}
                                        </div>
                                    @endif
                                    @if ($order->decrease_rate == 1)
                                        <div class="col-md-3 column">
                                            {{ $order->explainDecreaseRate() }}
                                        </div>
                                    @endif
                                    @if ($order->materials->count())
                                        <div class="col-md-3 column">
                                            {{ $order->explainRawMaterials() }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-3 column">{{ trans('order.chest') }}：45</div>
                                <div class="col-md-3 column">{{ trans('order.waist') }}：452</div>
                                <div class="col-md-3 column">{{ trans('order.lower_hem') }}：21</div>
                                <div class="col-md-3 column">{{ trans('order.shirt_length') }}：4151</div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 column">{{ trans('order.sleeve_length') }}：45</div>
                                <div class="col-md-3 column">{{ trans('order.shoulder_width') }} ：121</div>
                                <div class="col-md-3 column">{{ trans('order.cuff') }} ：45</div>
                                <div class="col-md-3 column"></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3 column">
                                    <span class="font-black bold">
                                    {{ trans('member.quoted_price') }}：
                                    </span>
                                    <span class="font-red bold">
                                    ¥{{ $order->pay_price }}
                                    </span>
                                </div>
                                <div class="col-md-3 column">
                                    <span class="font-black bold">
                                    {{ trans('member.order_status') }}：
                                    </span>
                                    <span class="font-red bold">
                                    {{ trans('member.progressing_1') }}
                                    </span>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <a href="{{ route('frontend.mypublishorder') }}" class="btn blue pull-right">{{ trans('member.back_to_list') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                @include('frontend.includes.summaryTailorDetail', ['applicant' => $order->tailor, 'selected' => true])
                            </div>
                            <hr>
                            @include('frontend.includes.orderChatMessageWebSocket',['orderId'=>$order->id, 'order' => $order, 'cad' => $cad])
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
         @include('frontend.includes.modalCreateExtraSize')
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')
    <script src="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
    <script src="/custom/js/frontend/myChatOrderMessage.js" type="text/javascript"></script>
@endsection