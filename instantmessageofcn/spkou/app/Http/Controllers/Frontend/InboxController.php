<?php
namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Models\UserInbox;
use App\Models\UserInboxMessages;
use App\Models\User;

class InboxController extends FrontendController
{
    public function index(Request $request) {
        \Auth::guard('users')->user()->load(['myInbox', 'myInbox.order', 'myInbox.fromUser', 'myInbox.messages']);
        $myInbox = \Auth::guard('users')->user()->myInbox;

        return view('frontend.inbox.index', ['myInbox' => $myInbox]);
    }

    public function readInbox(Request $request) {
        if ($request->has('id') && $request->get('id') != '') {
            $inbox = UserInbox::find($request->get('id'));

            if ($inbox) {
                if ($inbox->to_user_id != \Auth::guard('users')->user()->id) {
                    return makeJSONResponse(false, trans('common.action_no_permission'));
                }

                $user = \Auth::guard('users')->user();

                $unread = UserInboxMessages::where('inbox_id', '=', $inbox->id)->where('to_user_id', '=', $user->id)->where('is_read', '=', 0);
                try {
                    \DB::beginTransaction();
                    $count = $unread->count();
                    if ($count > 0) {
                        $user = User::where('id', '=', \Auth::guard('users')->user()->id)->first();
                        $user->unread_message = $user->unread_message - $count;
                        if ($user->unread_message < 0) {
                            $user->unread_message = 0;
                        }
                    }

                    $user->save();
                    $unread->update(['is_read' => 1]);

                    \DB::commit();
                    return makeJSONResponse(true, 'Success', ['unread' => $user->unread_message]);
                } catch (\Exception $e) {
                    return makeJSONResponse(false, $e->getMessage());
                    \DB::rollback();
                }
            } else {
                return makeJSONResponse(false, trans('common.unknown_error'));
            }
        } else {
            return makeJSONResponse(false, trans('common.unknown_error'));
        }
    }
}