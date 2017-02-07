<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use App\Models\User;
use Input;
use Validator;
use Illuminate\Http\Request;
use Auth;
use Image;
use File;
use App\Models\UserIdentity;
use App\Http\Requests\Frontend\UserIdentityCreateFormRequest;

class IdentityAuthenticationController extends FrontendController
{
    public function index(Request $request)
    {
        $identity = UserIdentity::where('user_id', '=', \Auth::guard('users')->user()->id)->whereIn('status', [UserIdentity::STATUS_PENDING, UserIdentity::STATUS_APPROVED])->orderBy('id', 'DESC');

        return view('frontend.identityAuthentication.index', ['identity' => $identity->first()]);
    }

    public function create(UserIdentityCreateFormRequest $request)
    {
        try {
            $identity = UserIdentity::whereIn('status', [UserIdentity::STATUS_PENDING])->where('user_id', '=', \Auth::guard('users')->user()->id)->orderBy('id', 'DESC')->first();

            if ($identity) {
                return makeResponse(trans('member.waiting_approval'), true);
            }

            $model = new UserIdentity();
            $model->user_id = \Auth::guard('users')->user()->id;
            $model->real_name = $request->get('real_name');
            $model->id_card_no = $request->get('id_card_no');
            $model->gender = $request->get('gender');
            if(app()->getLocale() == "cn") {
                $input_date_of_birth = convertCNDatePicker($request->get('date_of_birth'));
            }else{
                $input_date_of_birth = $request->get('date_of_birth');
            }
            $model->date_of_birth = $input_date_of_birth;
            $model->address = $request->get('address');
            $model->handphone_no = $request->get('handphone_no');
            if ($request->hasFile('id_image_front')) {
                $model->id_image_front = $request->file('id_image_front');
            }
            if ($request->hasFile('id_image_back')) {
                $model->id_image_back = $request->file('id_image_back');
            }

            $model->save();
            addSuccess(trans('member.successfully_submit_authentication'));
            return makeResponse(trans('member.successfully_submit_authentication'));
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function delete(Request $request) {
        $identity = UserIdentity::where('user_id', '=', \Auth::guard('users')->user()->id)->whereIn('status', [UserIdentity::STATUS_PENDING]);

        if ($identity->count()) {
            foreach ($identity->get() as $key => $var) {
                $var->delete();
            }
            addSuccess(trans('member.successfully_delete_authentication'));
        } else {
            addError(trans('member.authentication_not_found'));
        }

        return redirect()->route('frontend.identityauthentication');
    }
}