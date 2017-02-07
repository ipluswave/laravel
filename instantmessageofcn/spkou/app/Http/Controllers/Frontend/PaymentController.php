<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Models\OrderPayment;

class PaymentController extends FrontendController {

    public function showQr(Request $request) {
        $qr_code = $request->get('q');
        $order_id = $request->get('oid');
        $channel = $request->get('channel');

        if (notEmpty($qr_code) && notEmpty($order_id) && notEmpty($channel)) {
            return view('frontend.payment.qrcode',[
                'qr_code' => $qr_code,
                'order_id' => $order_id,
                'channel' => $channel
            ]);
        } else {
            addError(trans('common.unknown_error'));
            return redirect()->route('home');
        }
    }

    public function checkPayment(Request $request) {
        $payment = OrderPayment::where('order_no', '=', $request->get('oid'))->orderBy('id', 'DESC')->first();

        if ($payment) {
            $d = \Pingpp::Charge()->retrieve($payment->transaction_id);

            if ($d->paid === true) {
                return makeJSONResponse(true, 'Paid', ['paid' => 1]);
            } else {
                return makeJSONResponse(true, 'Unpaid', ['paid' => 0]);
            }
        } else {
            return makeJSONResponse(true, 'Unpaid', ['paid' => 0]);
        }
    }

    public function paymentCallback(Request $request) {
        $payment = OrderPayment::where('order_no', '=', $request->get('out_trade_no'))->orderBy('id', 'DESC')->first();
        $paid = false;
        $orderId = 0;

        if ($payment) {
            try {
                if ($payment->status == OrderPayment::STATUS_PENDING) {
                    //Find the payment status
                    $d = \Pingpp::Charge()->retrieve($payment->transaction_id);

                    if ($d->paid === true) {
                        //Update the payment status
                        $payment->status = OrderPayment::STATUS_SUCCESSFULLY;
                        $paid = true;

                        $payment->save();
                    } else {
                        $paid = false;
                    }
                } else {
                    if ($payment->status == OrderPayment::STATUS_SUCCESSFULLY) {
                        $paid = true;
                    } else {
                        $paid = false;
                    }
                }
                $orderId = $payment->order_id;
            } catch (\Exception $e) {
                addError($e->getMessage());
            }
        }

//        return 'Payment status: ' . $paid == true ? 'Paid' : 'Payment fail';

//        $paid = true;
        $orderNo = $request->get('out_trade_no');
        return view('frontend.payment.index',[
            'paid' => $paid,
            'orderNo' => $orderNo,
            'orderId' => $orderId
        ]);
    }

}