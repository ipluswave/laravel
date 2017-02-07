<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Models\Order;

class MyPublishOrderController extends FrontendController
{
    public function index(Request $request) {
        $user = \Auth::guard('users')->user();

        $orders = Order::with(['style', 'topBottom', 'category', 'applicants', 'applicants.user'])
            ->where('creator_id', '=', $user->id)->orderBy('id', 'DESC');

        if ($request->has('status') && $request->get('status') != '') {
            $orders->where('status', '=', $request->get('status'));
        }
        return view('frontend.myPublishOrder.index', ['myOrder' => $orders->get(), 'request' => $request]);
    }

    public function createExtraSize(Request $request) {
        return view('frontend.myPublishOrder.createextrasize');
    }
}