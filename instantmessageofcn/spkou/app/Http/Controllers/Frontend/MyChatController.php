<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use App\Http\Requests\Frontend\UserChatMessageCreateFormRequest;
use App\Http\Requests\Frontend\UserChatMessageCreateOrderFormRequest;
use App\Http\Requests\Frontend\UserChatMessageCreateOrderFileFormRequest;
use App\Http\Requests\Frontend\UserChatMessageCreateOrderImageFormRequest;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\UserInbox;
use App\Models\UserInboxMessages;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderApplicant;

class MyChatController extends FrontendController
{

    public function index(Request $request) {
        $userToInvite  = \App\Models\User::GetUsers()
                            ->where('id','!=',\Auth::guard('users')->user()->id)->get();
        $tmpUsers      = array();
        foreach ($userToInvite as $key => $var) {
            $realName = $var->email;
            $userRel = explode('@', $var->email);
            if(count($userRel) >= 2){
                $realName = $userRel[0];
            }
            $tmpUsers[$var->id]['name'] = $realName;
        }
        //dummy for invite user

        $recentChat    = ChatMessage::getRecentChat();
    	return view('frontend.myChat.index',[
                                            'recentChat'    => $recentChat,
                                            'userToInvite'  => $tmpUsers
                                            ]);
    }

    public static function pullChat($userRelative = null){
        $chatLog    = ChatMessage::pullChatMessage($userRelative);
        return response()->json([
                                    'status'    	=> 'OK',
                                    'receiverId'    => $chatLog['receiverId'],
                                    'realName'	    => $chatLog['realName'],
                                    'chatLog'       => $chatLog['lists']
                                    ]);
    }

    public function postChat(UserChatMessageCreateFormRequest $request){
        $ChatMessage                    = new ChatMessage();
        $ChatMessage->sender_user_id    = \Auth::guard('users')->user()->id;
        $ChatMessage->receiver_user_id  = $request->get('receiver');
        $ChatMessage->message           = $request->get('message');

        try {
            $ChatMessage->save();
            $userRel                    = \Auth::guard('users')->user()->email;
            $realName                   = $userRel;
            $userRel                    = explode('@', $userRel);
            if(count($userRel) >= 2){
                $realName               = $userRel[0];
            }
            return response()->json([
                                    'status'        => 'OK',
                                    'message'       => $ChatMessage->message,
                                    'time'          => $ChatMessage->created_at,
                                    'realName'      => $realName
                                    ]);
        } catch (Exception $e) {
            return response()->json([
                                    'status'        => 'not-OK',
                                    'message'       => $e->getMessage()
                                    ]);
        }
    }

    public function checkNewChat(){
        $chatNew    = ChatMessage::pullChatMessageNew();
        return response()->json([
                                    'status'        => 'OK'
                                    ]);
    }

    public function pullOrderChat($orderId = null){
        $chatLog    = ChatMessage::pullChatOrderMessage($orderId);
        return response()->json([
                                    'status'        => 'OK',
                                    'chatLog'       => $chatLog['lists']
                                    ]);
    }

    public function postOrderChat(UserChatMessageCreateOrderFormRequest $request){
        $ChatMessage                    = new ChatMessage();
        $ChatMessage->sender_user_id    = \Auth::guard('users')->user()->id;
        $ChatMessage->order_id          = $request->get('orderId');
        $ChatMessage->message           = $request->get('message');

        try {
            \DB::beginTransaction();

            //Here we create user inbox message
            $order = Order::with(['orderInbox'])->JoinApprovedApplicant()->find($request->get('orderId'));
            if (\Auth::guard('users')->user()->id == $order->creator_id) {
                $ui = UserInbox::where('to_user_id', '=', $order->applicant_user_id)->where('order_id', '=', $order->id);
            } else {
                $ui = UserInbox::where('to_user_id', '=', $order->creator_id)->where('order_id', '=', $order->id);
            }

            if ($ui->exists()) {
                $ui = $order->orderInbox;

                $uim_exists = UserInboxMessages::where('from_user_id', '=', \Auth::guard('users')->user()->id)->where('type', '=', UserInboxMessages::TYPE_ORDER_NEW_MESSAGE)->where('order_id', '=', $order->id);

                if ($uim_exists->exists()) {
                    $uim = $uim_exists->first();
                    $uim->updated_at = new \Carbon\Carbon();
                } else {
                    $uim = new UserInboxMessages();
                    $uim->updated_at = new \Carbon\Carbon();
                    $uim->from_user_id = \Auth::guard('users')->user()->id;
                    if (\Auth::guard('users')->user()->id == $order->creator_id) {
                        $uim->to_user_id = $order->applicant_user_id;
                    } else {
                        $uim->to_user_id = $order->creator_id;
                    }
                    $uim->type = UserInboxMessages::TYPE_ORDER_NEW_MESSAGE;
                }
            } else {
                //Here we send user inbox
                $ui = new UserInbox();
                $ui->from_user_id = \Auth::guard('users')->user()->id;
                if (\Auth::guard('users')->user()->id == $order->creator_id) {
                    $ui->to_user_id = $order->applicant_user_id;
                } else {
                    $ui->to_user_id = $order->creator_id;
                }
                $ui->type = UserInbox::TYPE_ORDER_APPLICANT_SELECTED;

                //Here we create user inbox message
                $uim = new UserInboxMessages();
                $uim->from_user_id = \Auth::guard('users')->user()->id;
                if (\Auth::guard('users')->user()->id == $order->creator_id) {
                    $uim->to_user_id = $order->applicant_user_id;
                } else {
                    $uim->to_user_id = $order->creator_id;
                }
                $uim->type = UserInboxMessages::TYPE_ORDER_NEW_MESSAGE;
            }

            $u = User::find($uim->to_user_id);

            if (!$u) {
                throw new \Exception(trans('common.unknown_error'));
            }

            $u->unread_message = UserInboxMessages::where('to_user_id', '=', $u->id)->where('is_read', '=', 0)->count() + 1;
            if (!$u->save()) {
                throw new \Exception(trans('common.unknown_error'));
            }

            $ui->order_id = $order->id;
            if (!$ui->save()) {
                throw new \Exception(trans('common.unknown_error'));
            }

            $uim->is_read = 0;
            $uim->order_id = $order->id;
            $uim->inbox_id = $ui->id;
            if (!$uim->save()) {
                throw new \Exception(trans('common.unknown_error'));
            }

            $ChatMessage->save();
            if(\Auth::guard('users')->user()->nick_name != ''){
                $name = \Auth::guard('users')->user()->nick_name;
            }else{
                $email      = \Auth::guard('users')->user()->email;
                $name       = explode('@', $email);
                if(count($name) >= 2){
                    $name = $name[0];
                }else{
                    $name = $email;
                }
            }
            $avatar = \Auth::guard('users')->user()->getAvatar();
            \DB::commit();
            return response()->json([
                                    'status'        => 'OK',
                                    'message'       => $ChatMessage->message,
                                    'time'          => date('d M, Y H:i',strtotime($ChatMessage->created_at)),
                                    'realName'      => $name,
                                    'avatar'        => $avatar
                                    ]);
        } catch (Exception $e) {
            \DB::rollback();
            return response()->json([
                                    'status'        => 'not-OK',
                                    'message'       => $e->getMessage()
                                    ]);
        }
    }

    public function postInviteHelpdeskChat($orderId = null){
        $ChatMessage                    = new ChatMessage();
        $ChatMessage->sender_user_id    = \Auth::guard('users')->user()->id;
        $ChatMessage->receiver_staff_id = 1;
        $ChatMessage->order_id          = $orderId;
        if(\Auth::guard('users')->user()->real_name != ''){
            $name = \Auth::guard('users')->user()->real_name;
        }else if(\Auth::guard('users')->user()->nick_name != ''){
            $name = \Auth::guard('users')->user()->real_name;
        }else{
            $email      = \Auth::guard('users')->user()->email;
            $name       = explode('@', $email);
            if(count($name) >= 2){
                $name = $name[0];
            }else{
                $name = $email;
            }
        }
        $ChatMessage->message           = '--'.$name.' invite help desk to this conversation--';

        try {
            $ChatMessage->save();
            $avatar = \Auth::guard('users')->user()->getAvatar();
            
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

    public function postOrderChatFile(UserChatMessageCreateOrderFileFormRequest $request){
        $ChatMessage                    = new ChatMessage();
        $ChatMessage->sender_user_id    = \Auth::guard('users')->user()->id;
        $ChatMessage->order_id          = $request->get('orderId');
        $ChatMessage->file              = $request->file('file');

        //Message must be upload after file
        $ChatMessage->message           = '--file upload: <a href="javascript:;" class="cad-file-link" data-file="/' . $ChatMessage->file . '">'.$request->get('message').'</a>';

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

    public function pullOrderChatFile($orderId = null){
        $chatLog    = ChatMessage::pullChatOrderMessageFile($orderId);
        return response()->json([
                                    'status'        => 'OK',
                                    'chatLog'       => $chatLog['lists'],
                                    'count'         => $chatLog['count']
                                    ]);
    }

    public function postOrderChatImage(UserChatMessageCreateOrderImageFormRequest $request){
        $ChatMessage                    = new ChatMessage();
        $ChatMessage->sender_user_id    = \Auth::guard('users')->user()->id;
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
}