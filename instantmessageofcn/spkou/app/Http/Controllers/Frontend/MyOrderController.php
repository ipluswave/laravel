<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderApplicant;

class MyOrderController extends FrontendController
{
    public function index(Request $request) {
        $orders = Order::with(['applicants', 'style', 'category', 'topBottom'])
            ->JoinAppliedCheck()
            ->whereHas('applicants', function ($q) {
                $q->where('user_id', '=', \Auth::guard('users')->user()->id);
            })
            ->paginate(15);

        return view('frontend.myOrder.index', ['orders' => $orders]);
    }
}