<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Http\Controllers\BackendController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Auth\LoginStaffFormRequest;
use App\Http\Requests\Auth\StaffProfileFormRequest;
use App\Models\Staff;
use Carbon;

class StaffController extends BackendController {
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function logout(Request $request) {
        Auth::guard('staff')->logout();
        return redirect()->guest(route('home'));
    }

    public function register(Request $request) {
        return redirect()->guest(route('backend.index'));
    }

    public function registerPost(Request $request) {
        return redirect()->guest(route('backend.index'));
    }

    public function login(Request $request) {
        return view('auth.loginstaff');
    }

    public function loginPost(LoginStaffFormRequest $request) {
        $login = $request->get('login');
        $password = $request->get('password');

        $field = null;

        if (filter_var($request->get('login'), FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } else {
            $field = 'username';
        }

        try {
            $credentials = [
                $field => $login,
                'password' => $password
            ];

            $throttles = $this->isUsingThrottlesLoginsTrait();

            if ($throttles && $this->hasTooManyLoginAttempts($request)) {
                return $this->sendLockoutResponse($request);
            }

            if (Auth::guard('staff')->attempt($credentials, $request->has('remember'))) {
                return $this->handleUserWasAuthenticated($request, $throttles);
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            if ($throttles) {
                $this->incrementLoginAttempts($request);
            }

            return redirect()->route('staff.login')->withInput()->withErrors([$this->getFailedLoginMessage()]);
        } catch (\Exception $e) {
            return redirect()->route('backend.index')->withInput()->withErrors(['未知错误，请稍候再试']);
        }
    }

    public function authenticated(Request $request, $user) {
        return redirect()->route('backend.index');
    }

    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        return $this->authenticated($request, Auth::guard('staff'));
    }

    public function profile(Request $request) {
        return view('auth.staffprofile', ['model' => Auth::guard('staff')->user()]);
    }

    public function profilePost(StaffProfileFormRequest $request) {
        if (Auth::guard('staff')->attempt([
            'email' => Auth::guard('staff')->user()->email,
            'password' => $request->get('current_password')
        ], false, false)) {
            $user = Auth::guard('staff')->user();
            $user->password = $request->get('new_password');

            try {
                $user->save();
                return makeResponse('成功编辑个人资料');
            } catch (\Exception $e) {
                return makeResponse($e->getMessage());
            }
        } else {
            //Incorrect current password
            return makeResponse('当前密码不正确', true);
        }
    }
}