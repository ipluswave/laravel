<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderApplicant;
use App\Models\UserInbox;
use App\Models\UserInboxMessages;

class OrderController extends FrontendController
{
    public function details(Request $request, $id) {
        $order = Order::with(['creator', 'style', 'topBottom', 'category', 'materials', 'applicants'])->JoinAppliedCheck()->find($id);

        if ($order->applicant_id != null && $order->applicant_status == \App\Models\OrderApplicant::STATUS_ACCEPTED) {
            $available = true;
        } else {
            $available = false;
        }
        return view('frontend.order.details', ['order' => $order, 'available' => $available]);
    }

    public function applyOrder(Request $request, $id = null) {
        if ($id == null) {
            return response(trans('order.order_not_found'), 422);
        }

        $order = Order::with(['creator', 'style', 'topBottom', 'category', 'materials', 'applicants'])->JoinAppliedCheck()->find($id);

        if ($order) {
            if ($order->applicant_id != null) {
                return response(trans('order.applied_please_be_patient'), 422);
            } else {
                $applicant = new OrderApplicant();
                $applicant->user_id = \Auth::guard('users')->user()->id;
                $applicant->order_id = $order->id;
                $applicant->status = OrderApplicant::STATUS_PENDING;

                if ($applicant->save()) {
                    return makeJSONResponse(true, trans('order.successfully_apply_order'), ['applicant_id' => $applicant->id]);
                } else {
                    return response(trans('order.unable_to_apply_order'), 422);
                }
            }
        } else {
            return response(trans('order.order_not_found'), 422);
        }
    }

    public function deleteApplyOrder(Request $request, $id = null) {
        if ($id == null) {
            return response(trans('order.order_apply_not_found'), 422);
        }

        $apply = OrderApplicant::find($id);

        if (!$apply || $apply->user_id != \Auth::guard('users')->user()->id) {
            return response(trans('order.order_apply_not_found'), 422);
        }

        //Check if status is approved or not
        if ($apply->status == OrderApplicant::STATUS_PENDING) {
            $order_id = $apply->order_id;
            $apply->delete();

            return makeJSONResponse(true, trans('order.successfully_delete_apply'), ['order_id' => $order_id]);
        } else {
            return response(trans('order.cannot_delete_apply'), 422);
        }
    }

    public function approveApplicant(Request $request, $id) {
        $model = OrderApplicant::with(['order', 'user'])->find($id);

        if ($model) {
            //Check if user is current logged in user
            if ($model->order) {
                if ($model->order->creator_id != \Auth::guard('users')->user()->id) {
                    return response(trans('common.action_no_permission'), 422);
                }
            } else {
                return response(trans('order.order_apply_not_found'), 422);
            }

            //Check if order have accepted applicant or not
            $exists = OrderApplicant::where('order_id', '=', $model->order_id)->where('status', '=', OrderApplicant::STATUS_ACCEPTED)->count();
            if ($exists) {
                return response(trans('common.unknown_error'), 422);
            }

            $model->status = OrderApplicant::STATUS_ACCEPTED;
            $order = $model->order;
            $order->status = Order::STATUS_HIRED;

            //Here we send user inbox
            $ui = new UserInbox();
            $ui->from_user_id = \Auth::guard('users')->user()->id;
            $ui->to_user_id = $model->user_id;
            $ui->type = UserInbox::TYPE_ORDER_APPLICANT_SELECTED;

            //Here we create user inbox message
            $uim = new UserInboxMessages();
            $uim->from_user_id = \Auth::guard('users')->user()->id;
            $uim->to_user_id = $model->user_id;
            $uim->type = UserInboxMessages::TYPE_ORDER_APPLICANT_SELECTED;

            try {
                \DB::beginTransaction();

                if (!$model->save()) {
                    throw new \Exception(trans('common.unknown_error'));
                }

                if (!$order->save()) {
                    throw new \Exception(trans('common.unknown_error'));
                }

                $ui->order_id = $order->id;
                if (!$ui->save()) {
                    throw new \Exception(trans('common.unknown_error'));
                }

                $uim->order_id = $order->id;
                $uim->inbox_id = $ui->id;
                if (!$uim->save()) {
                    throw new \Exception(trans('common.unknown_error'));
                }

                //Update the applicant unread message
                $applicant = $model->user;
                $applicant->unread_message = UserInboxMessages::where('to_user_id', '=', $applicant->id)->where('is_read', '=', 0)->count();
                if (!$applicant->save()) {
                    throw new \Exception(trans('common.unknown_error'));
                }

                addSuccess(trans('order.applicant_approved'));
                \DB::commit();
                return makeJSONResponse(true, 'order.applicant_approved');
            } catch (\Exception $e) {
                \DB::rollback();
                return response($e->getLine() . '/' . $e, 422);
            }
        } else {
            return response(trans('order.order_apply_not_found'), 422);
        }
    }
}