<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserResetVerifications;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function accountChangePasswordForPhone(Request $request) {
        if (isPost()) {
            $input_code = $request->get('code');
            if ($input_code == '') {
                return makeJSONResponse(false, '1101');
            }

            $input_contact_number = $request->get('contact_number');
            if ($input_contact_number == '' || !isChinaMobile($input_contact_number)) {
                return makeJSONResponse(false, '1104');
            }

            $input_password = $request->get('password');
            if ($input_password == '' || strlen($input_password) < 6) {
                return makeJSONResponse(false, '1102');
            }

            $input_password_confirmation = $request->get('password_confirmation');
            if ($input_password != $input_password_confirmation) {
                return makeJSONResponse(false, '1103');
            }

            $user = User::where('contact_number', '=', $input_contact_number)->first();

            if (!$user) {
                return makeJSONResponse(false, trans('member.member_not_exists'));
            }

            $before = new \Carbon\Carbon();
            $before->subMinute(10);
            $now = new \Carbon\Carbon();

            $code = UserResetVerifications::where('code', '=', $input_code)
                ->where('user_id', '=', $user->id)
                ->whereBetween('created_at', [$before, $now])
                ->where('status', '=', UserResetVerifications::STATUS_UNUSED);

            if ($code->exists()) {
                $code = $code->first();
            } else {
                return makeJSONResponse(false, trans('member.verification_not_exists_or_expired'));
            }

            //Change the user password and use the code
            try {
                \DB::beginTransaction();
                $user->password = $input_password;
                $code->status = UserResetVerifications::STATUS_USED;

                if (!$code->save()) {
                    return makeJSONResponse(false, null);
                }

                if ($user->save()) {
                    $msg = trans('member.reset_password_successfully');
                    \DB::commit();
                    addSuccess($msg);
                    return makeJSONResponse(true, $msg);
                } else {
                    \DB::rollback();
                    return makeJSONResponse(false, null);
                }
            } catch (\Exception $e) {
                \DB::rollback();
                return makeJSONResponse(false, $e->getMessage());
            }
        } else {
            return view('auth.phoneresetpassword');
        }
    }
}
