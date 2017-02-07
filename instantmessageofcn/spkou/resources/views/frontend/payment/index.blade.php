@extends('frontend.layouts.default')

@section('title')
Payment Status
@endsection

@section('description')
Payment Status
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/custom/css/frontend/payment.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper" style="height:350px;">
        <!-- BEGIN CONTENT BODY -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <span class="title">
                            @if ( $paid == true )
                            支付成功
                            @else
                            支付失败
                            @endif
                        </span>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 text-right img-status @if( $paid == true ) success @else fail @endif">
                                @if ( $paid == true )
                                <i class="fa fa-check-circle"></i>
                                @else
                                <i class="fa fa-exclamation-circle"></i>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <div class="payment-status">
                                    @if ( $paid == true )
                                    支付成功!
                                    @else
                                    支付失败!
                                    @endif
                                </div>
                                <div class="info">
                                    @if ( $paid == true )
                                    您的订单已创建成功，订单编号为<span class="order-id">{{ $orderNo }}</span>
                                    @else
                                    您的订单尚未创建成功。
                                    @endif
                                </div>
                                <div class="action-link">
                                    <span class="continue">
                                        <a href="{{ route('home') }}">返回首页</a>
                                    </span>
                                    <span class="back">
                                        @if ( $paid == true )
                                        <a href="{{ route('frontend.createorder') }}">继续发单</a>
                                        @else
                                        <a href="{{ route('frontend.editorder', ['id' => $orderId]) }}">返回修改</a>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE BASE CONTENT -->
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection


@section('footer')

@endsection




