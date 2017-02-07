<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Input;
use Datatables;
use Validator;
use DB;
use Carbon;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;
use App\Models\Order;
use App\Models\OrderConversation;
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\Category;
use App\Models\OrderApplicant;

class OrderController extends BackendController
{
    public function index(Request $request, $id = null) {
        return view('backend.order.index');
    }

    public function indexDt(Request $request, $id = null) {
        $model = Order::GetOrder();

        return Datatables::of($model)
            ->addColumn('creator_name', function ($model) {
                return $model->getCreator();
            })
			->addColumn('planned_date', function ($model) {
                return $model->getPlannedDate();
            })
			->addColumn('status_text', function ($model) {
                return $model->getStatusText();
            })
			->addColumn('payment_method', function ($model) {
                return $model->getPaymentMethod();
            })
            ->filter(function ($model) {
                return $model->GetFilteredResults();
            })
            ->addColumn('actions', function ($model) {
                $actions = '';
                $actions .= buildRemoteLink([
                    'url' => route('backend.order.info', ['id' => $model->id]),
                    'description' => '<i class="fa fa-info-circle"></i>',
                ]);
                return $actions;
            })
            ->make(true);
    }

    public function create(Request $request) {
        return view('backend.bank.create');
    }

    public function createPost(BankCreateFormRequest $request, $id = null) {
        try {
            $model = new Bank();
            $model->name_cn = $request->get('name_cn');
            $model->name_en = $request->get('name_en');
            $model->background_color = $request->get('background_color');
            $model->font_color = $request->get('font_color');
            $model->logo = $request->file('logo');

            $model->save();
            return makeResponse('成功新增银行');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function edit($id) {
        $model = Bank::GetBank()->find($id);

        return view('backend.bank.edit', ['model' => $model]);
    }

    public function editPost(BankEditFormRequest $request, $id) {
        $model = Bank::GetBank()->find($id);

        if (!$model) {
            return makeResponse('银行不存在', true);
        }

        try {
            $model->name_cn = $request->get('name_cn');
            $model->name_en = $request->get('name_en');
            $model->background_color = $request->get('background_color');
            $model->font_color = $request->get('font_color');
            if ($request->hasFile('logo')) {
                $model->logo = $request->file('logo');
            }

            $model->save();
            return makeResponse('成功编辑银行');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function delete($id) {
        $model = Bank::GetBank()->find($id);

        try {
            if ($model->delete()) {
                return makeResponse('成功删除银行');
            } else {
                throw new \Exception('未能删除银行，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
	
    //======================================== conflict order
	public function conflict() {
        return view('backend.order.conflict');
    }
	
	public function conflictDt(Request $request) {
        $ChatMessage    = ChatMessage::where('receiver_staff_id',1)->lists('order_id');
        $model          = Order::getOrder()->whereIn('id',$ChatMessage);

        return Datatables::of($model)
            ->addColumn('creator_name', function ($model) {
                return $model->getCreator();
            })
            ->filter(function ($model) {
                return $model->GetFilteredResults();
            })
            ->addColumn('actions', function ($model) {
                $actions = buildLinkHtml([
                    'url' => route('backend.order.conflict.conversation', ['order_id' => $model->id]),
                    'description' => '<i class="fa fa-commenting-o"></i>',
                ]);
                return $actions;
            })
            ->make(true);
    }
	
	public function conflictConversation($id) {
		$tailors = User::where("is_tailor", 1)->get();
		$error = Session::get('error');
        return view('backend.order.conversation',
        			[
        				'orderId' => $id,
        				'tailors' => $tailors,
        				'error' => $error
        			]
        		);
	}

    public function postOrderChat(\App\Http\Requests\Backend\StaffOrderConflictFormRequest $request){
        $ChatMessage                    = new \App\Models\ChatMessage();
        $ChatMessage->sender_staff_id   = 1;
        $ChatMessage->order_id          = $request->get('orderId');
        $ChatMessage->message           = $request->get('message');

        try {
            $ChatMessage->save();
            $name = 'Help Desk';
            $avatar = asset('images/avatar.png');
            return response()->json([
                                    'status'        => 'OK',
                                    'message'       => $ChatMessage->message,
                                    'time'          => date('d M, Y H:i',strtotime($ChatMessage->created_at)),
                                    'realName'      => $name,
                                    'avatar'        => $avatar
                                    ]);
        } catch (Exception $e) {
            return response()->json([
                                    'status'        => 'not-OK',
                                    'message'       => $e->getMessage()
                                    ]);
        }
    }

    public function pullOrderChat($orderId = null){
        $chatLog    = \App\Models\ChatMessage::pullChatOrderMessage($orderId);
        return response()->json([
                                    'status'        => 'OK',
                                    'chatLog'       => $chatLog['lists']
                                    ]);
    }

    public function postOrderChatImage(\App\Http\Requests\Backend\StaffOrderConflictImageFormRequest $request){
        $ChatMessage                    = new ChatMessage();
        $ChatMessage->sender_staff_id   = 1;
        $ChatMessage->order_id          = $request->get('orderId');
        $ChatMessage->message           = $request->get('message');
        $ChatMessage->file              = $request->file('file');

        try {
            $ChatMessage->save();
            return response()->json([
                                    'status'        => 'OK'
                                    ]);
        } catch (Exception $e) {
            return response()->json([
                                    'status'        => 'not-OK',
                                    'message'       => $e->getMessage()
                                    ]);
        }
    }
    //======================================== end conflict order

    public function conflictRefund($orderid)
	{
		//TODO: transfer money
		$order = Order::GetOrder()->find($orderid);
		$order->status = 3;
		$order->save();
		// remove all chat message from admin conflict support status
		$ChatMessage = ChatMessage::where('receiver_staff_id', 1)
			->where('order_id', $orderid)
			->update(['receiver_staff_id' => NULL]);
		return redirect()->route('backend.order.conflict');
	}
	
	public function conflictRelease($orderid)
	{
		//TODO: transfer money
		$order = Order::GetOrder()->find($orderid);
		$order->status = 3;
		$order->save();
		// remove all chat message from admin conflict support status
		$ChatMessage = ChatMessage::where('receiver_staff_id', 1)
			->where('order_id', $orderid)
			->update(['receiver_staff_id' => NULL]);
		return redirect()->route('backend.order.conflict');
	}
	
	public function conflictForward(Request $request)
	{
		$tailorId = $request->tailor;
		$orderId = $request->orderId;
		
		$order = Order::GetOrder()->find($orderId);
		$order->status = 1;
		$order->save();	
		
		$orderApplicant = OrderApplicant::where("order_id", $orderId)
							->where("status", OrderApplicant::STATUS_ACCEPTED)
							->first();
		if ($orderApplicant) {
			$orderApplicant->status = OrderApplicant::STATUS_REJECTED;
			$orderApplicant->save();			
		}
		//TODO: transfer money
		
		$newApplicant = new OrderApplicant();
        $newApplicant->user_id = $tailorId;
        $newApplicant->order_id = $order->id;
        $newApplicant->status = OrderApplicant::STATUS_PENDING;

        if ($newApplicant->save()) {
        	// remove all chat message from admin conflict support status
			$ChatMessage = ChatMessage::where('receiver_staff_id', 1)
				->where('order_id', $order->id)
				->update(['receiver_staff_id' => NULL]);
            return redirect()->route('backend.order.conflict');
        } else {
        	Session::flashdata('error', 'Sorry, we can\'t complete your request.');
            return redirect()->route('backend.order.conflict.conversation', $orderId);
        }
	}

	public function info($id)
	{
		$model = Order::find($id);
		// $category = Category::where('parent_id',1)->get();
		// var_dump($category);die;
        return view('backend.order.info', ['model' => $model]);
	}
}
