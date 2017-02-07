@extends('frontend.layouts.default')

@section('title')
Scan and pay
@endsection

@section('description')
Scan QR Code and pay
@endsection

@section('author')
bengsnail
@endsection

@section('header')
    <link href="/custom/css/frontend/payment.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper" style="height:500px;">
        <!-- BEGIN CONTENT BODY -->
            <!-- BEGIN PAGE BASE CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <span class="title">
                            微信支付
                        </span>
                        <hr />
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center">请扫描二维码进行支付</h3>
                                <img style="margin: 0 auto;" class="img-responsive" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(350)->generate($qr_code)) !!}" />
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
    <script type="text/javascript">
        +function ($) {
            $(document).ready(function () {
                var checking = false;
                var order_id = '{{ $order_id }}';
                setInterval(function() {
                    if (checking === false) {
                        $.ajax({
                            url: '{{ route('payment.checkpayment') }}',
                            method: 'get',
                            dataType: 'json',
                            data: {oid: order_id},
                            beforeSend: function () {
                                checking = true;
                            },
                            success: function (resp) {
                                if (resp.status == 'success') {
                                    if (typeof resp.data.paid !== 'undefined' && resp.data.paid == 1) {
                                        window.location.href = '{{ route('payment.callback') }}' + '?out_trade_no=' + order_id;
                                    }
                                }
                            },
                            error: function (resp) {

                            },
                            complete: function () {
                                checking = false;
                            }
                        });
                    }
                }, 5000);
            });
        }(jQuery);
    </script>
@endsection




