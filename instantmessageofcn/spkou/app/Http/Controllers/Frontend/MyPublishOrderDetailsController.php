<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderApplicant;
use App\Models\ChatMessage;

class MyPublishOrderDetailsController extends FrontendController
{
    public function index(Request $request, $id) {
    	$order = Order::with(['applicants', 'tailor', 'creator', 'sizes', 'materials', 'processingGuides', 'cads', 'properties', 'style', 'topBottom', 'category'])->find($id);

        if (!$order) {
            addError(trans('order.order_not_found'));
            return redirect()->route('home');
        }

        //Check for page permission
        $user_id = \Auth::guard('users')->user()->id;

        if ($order->creator_id != $user_id && (!$order->tailor || ($order->tailor->user_id != $user_id))) {
            addError(trans('common.action_no_permission'));
            return redirect()->route('home');
        }

        $cad = ChatMessage::where('is_cad_file', '=', 1)->where('order_id', '=', $order->id)->get();

        return view('frontend.myPublishOrderDetails.index', ['order' => $order, 'cad' => $cad]);
    }

    public function indexWebSocket(Request $request, $id) {
        $order = Order::with(['applicants', 'tailor', 'creator', 'sizes', 'materials', 'processingGuides', 'cads', 'properties', 'style', 'topBottom', 'category'])->find($id);

        if (!$order) {
            addError(trans('order.order_not_found'));
            return redirect()->route('home');
        }

        //Check for page permission
        $user_id = \Auth::guard('users')->user()->id;

        if ($order->creator_id != $user_id && (!$order->tailor || ($order->tailor->user_id != $user_id))) {
            addError(trans('common.action_no_permission'));
            return redirect()->route('home');
        }

        $cad = ChatMessage::where('is_cad_file', '=', 1)->where('order_id', '=', $order->id)->get();

        return view('frontend.myPublishOrderDetails.indexWebSocket', ['order' => $order, 'cad' => $cad]);
    }

    public function ChatModule(Request $request) {
    	//for temp variable 
    	$orderId = 1;
        return view('frontend.myPublishOrderDetails.chatModule',
        			[
        				'orderId'=>$orderId
        			]
        		);
    }

    public function createExtraSize(Request $request) {
        return view('frontend.myPublishOrderDetails.createextrasize');
    }
}