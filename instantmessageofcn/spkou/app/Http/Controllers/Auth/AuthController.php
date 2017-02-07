<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterUserFormRequest;
use App\Http\Requests\Auth\LoginUserFormRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\UserContactVerifications;

class AuthController extends Controller {
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function register(Request $request) {
        return view('auth.register');
    }

    public function registerPost(Request $request) {
        try {
            \DB::beginTransaction();

            if (!$request->has('contact_number') || $request->get('contact_number') == '' || !isChinaMobile($request->get('contact_number'))) {
                return makeJSONResponse(false, '1104');
            }

            if (!$request->has('code') || $request->get('code') == '') {
                return makeJSONResponse(false, '1101');
            }

            if (!$request->has('password') || $request->get('password') == '' || strlen($request->get('password')) < 6) {
                return makeJSONResponse(false, '1102');
            }

            if ($request->get('password') != $request->get('password_confirmation')) {
                return makeJSONResponse(false, '1103');
            }

            if (!$request->has('accept_tnc') && $request->get('accept_tnc') != 1) {
                return makeJSONResponse(false, '1106');
            }

            //If contact number registered
            $exists = User::where('contact_number', '=', $request->get('contact_number'))->exists();
            if ($exists) {
                return makeJSONResponse(false, '1105');
            }

            $before = new \Carbon\Carbon();
            $before->subMinute(10);
            $now = new \Carbon\Carbon();

            $verification = UserContactVerifications::where('code', '=', strtoupper($request->get('code')))
                ->whereBetween('created_at', [$before, $now])
                ->where('status', '=', UserContactVerifications::STATUS_UNUSED)
                ->orderBy('id', 'DESC');

            if ($verification->exists()) {
                $verification = $verification->first();
            } else {
                return makeJSONResponse(false, trans('member.verification_not_exists_or_expired'));
            }

            if ($verification->contact_number != $request->get('contact_number')) {
                return makeJSONResponse(false, trans('member.verification_code_not_yours'));
            }

            $user = new User();
            $user->contact_number = $request->get('contact_number');
            $user->password = $request->get('password');

            //Check qq open id already bind or not
            if ($request->has('qqlogin')) {
                $qq_exists = User::where('qq_open_id', '=', $request->get('qq_open_id'));
                if ($qq_exists->exists()) {
                    return makeJSONResponse(false, trans('member.qq_account_exists'));
                }

                if (!$request->session()->has('qq_open_id')) {
                    return makeResponse(trans('common.unknown_error', true));
                }

                if ($request->session()->get('qq_open_id') != $request->get('qq_open_id')) {
                    return makeResponse(trans('common.unknown_error', true));
                }

                if ($request->session()->has('qq_open_id') && $request->session()->get('qq_open_id') != ''
                    && $request->has('qq_open_id') && $request->get('qq_open_id') != '') {
                    $user->qq_open_id = $request->session()->get('qq_open_id');
                } else {
                    return makeResponse(trans('common.unknown_error', true));
                }
            }

            //Check weibo open id already bind or not
            if ($request->has('weibologin')) {
                $weibo_exists = User::where('weibo_open_id', '=', $request->get('weibo_open_id'));
                if ($weibo_exists->exists()) {
                    return makeJSONResponse(false, trans('member.weibo_account_exists'));
                }

                if (!$request->session()->has('weibo_open_id')) {
                    return makeResponse(trans('common.unknown_error', true));
                }

                if ($request->session()->get('weibo_open_id') != $request->get('weibo_open_id')) {
                    return makeResponse(trans('common.unknown_error', true));
                }

                if ($request->session()->has('weibo_open_id') && $request->session()->get('weibo_open_id') != ''
                    && $request->has('weibo_open_id') && $request->get('weibo_open_id') != '') {
                    $user->weibo_open_id = $request->session()->get('weibo_open_id');
                } else {
                    return makeResponse(trans('common.unknown_error', true));
                }
            }

            //Check weixin open id already bind or not
            if ($request->has('weixinlogin')) {
                $weixin_exists = User::where('weixin_open_id', '=', $request->get('weixin_open_id'));
                if ($weixin_exists->exists()) {
                    return makeJSONResponse(false, trans('member.weixin_account_exists'));
                }

                if (!$request->session()->has('weixin_open_id')) {
                    return makeResponse(trans('common.unknown_error', true));
                }

                if ($request->session()->get('weixin_open_id') != $request->get('weixin_open_id')) {
                    return makeResponse(trans('common.unknown_error', true));
                }

                if ($request->session()->has('weixin_open_id') && $request->session()->get('weixin_open_id') != ''
                && $request->has('weixin_open_id') && $request->get('weixin_open_id') != '') {
                    $user->weixin_open_id = $request->session()->get('weixin_open_id');
                } else {
                    return makeResponse(trans('common.unknown_error', true));
                }
            }

            $verification->status = UserContactVerifications::STATUS_USED;
            $verification->save();

            $user->save();

            if ($request->has('qqlogin') && $request->get('qqlogin') == 1) {
                $request->session()->forget('qq_open_id');
                \Auth::guard('users')->login($user);
            }
            if ($request->has('weibologin') && $request->get('weibologin') == 1) {
                $request->session()->forget('weibo_open_id');
                \Auth::guard('users')->login($user);
            }
            if ($request->has('weixinlogin') && $request->get('weixinlogin') == 1) {
                $request->session()->forget('weixin_open_id');
                \Auth::guard('users')->login($user);
            }

            \DB::commit();

            addSuccess(trans('member.successfully_register'));

            return makeJSONResponse(true, trans('member.successfully_register'));
        } catch (\Exception $e) {
            \DB::rollback();
            return makeJSONResponse(false, $e->getMessage());
        }
    }

    public function login(Request $request) {
        return view('auth.login');
    }

    public function loginPost(Request $request) {
        $login = $request->get('login');
        $password = $request->get('password');

        if ($login == '' || !isChinaMobile($login)) {
            return makeJSONResponse(false, '1101');
        }

        if ($password == '') {
            return makeJSONResponse(false, '1101');
        }

        try {
            $credentials = [
                'contact_number' => $login,
                'password' => $password
            ];

            $throttles = $this->isUsingThrottlesLoginsTrait();

            if ($throttles && $this->hasTooManyLoginAttempts($request)) {
                return $this->sendLockoutResponse($request);
            }

            if (Auth::guard('users')->attempt($credentials)) {
                return $this->handleUserWasAuthenticated($request, $throttles);
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            if ($throttles) {
                $this->incrementLoginAttempts($request);
            }

            return makeJSONResponse(false, '1101');
        } catch (\Exception $e) {
            return makeJSONResponse(false, trans('common.unknown_error'));
        }
    }

    public function logout(Request $request) {
        Auth::guard('users')->logout();
        return redirect()->route('home');
    }

    public function authenticated(Request $request, $user) {
        addSuccess(trans('member.successfully_login'));

        User::checkAndSaveLocation();
        return makeJSONResponse(true, trans('member.successfully_login'));
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        return $this->authenticated($request, Auth::guard('users'));
    }
}
