<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use App\Models\User;
use App\Models\UserIdentity;
use Input;
use Validator;
use Illuminate\Http\Request;
use Auth;
use Image;
use File;

class VerificationController extends FrontendController
{
    public $me = null;
    public function __construct() {
        parent::__construct();
        if (Auth::guard('users')->check()) {
            $this->me = Auth::guard('users')->user();
        }
    }
    public function index(Request $request)
    {
        return view('frontend.verification.index');
    }
    public function masterVerifyAgain(Request $request) {
        try {
            \DB::beginTransaction();
            $user = \Auth::guard('users')->user();
            $user->is_validated = 0;
            $user->is_tailor = 0;

            $verification = UserIdentity::where('user_id', '=', $user->id);

            $user->save();
            $verification->delete();
            \DB::commit();
            addSuccess(trans('member.successfully_reset_master_verification'));
            return makeJSONResponse(true, trans('member.successfully_reset_master_verification'));
        } catch (\Exception $e) {
            \DB::rollback();
            return makeJSONResponse(false, $e->getMessage());
        }

    }
    public function masterVerify(Request $request) {
        return view('frontend.verification.masterverify');
    }
    public function masterVerifyPost(Request $request) {
        try {
            if (!$request->has('real_name') || $request->get('real_name') == '')
                throw new \Exception(trans('member.phd_real_name'));
            if (!$request->has('id_card_no') || $request->get('id_card_no') == '' || strlen($request->get('id_card_no')) < 18)
                throw new \Exception(trans('member.phd_id_card_no'));
            if (!$request->has('gender') || !in_array($request->get('gender'), [0, 1]))
                throw new \Exception(trans('member.please_select_gender'));
            if (!$request->hasFile('id_image_front'))
                throw new \Exception(trans('member.please_upload_id_image_front'));
            if (!$request->hasFile('id_image_back'))
                throw new \Exception(trans('member.please_upload_id_image_back'));

            $me = \Auth::guard('users')->user();
            $id = new UserIdentity();
            $id->user_id = $me->id;
            $id->real_name = $request->get('real_name');
            $id->id_card_no = $request->get('id_card_no');
            $id->gender = $request->get('gender');
            $id->id_image_front = $request->file('id_image_front');
            $id->id_image_back = $request->file('id_image_back');

            //Not sure why, but delete the old identity should be good here
            $exists = UserIdentity::where('user_id', '=', $me->id);
            if ($exists->exists()) {
                $exists->delete();
            }

            //TESTING PURPOSE DIRECT SET STATUS TO APPROVED
            $id->status = 1;
            $me->is_validated = 1;
            $me->is_tailor = 1;

            $id->save();
            $me->save();
            \DB::commit();

            addSuccess(trans('successfully_submit_authentication'));
            return makeResponse(trans('successfully_submit_authentication'));
        } catch (\Exception $e) {
            \DB::rollback();
            return makeResponse($e->getMessage(), true);
        }
    }
}