<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Socialize;
use App\Models\User;
use iscms\Alisms\SendsmsPusher as Sms;
use App\Models\UserContactVerifications;
use App\Models\UserResetVerifications;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Sms $sms)
    {
        $this->sms = $sms;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getResetVerificationSms(Request $request) {
        $contact_number = $request->get('contact_number');
        if (isChinaMobile($contact_number)) {
            $user = User::where('contact_number', '=', $contact_number)->first();
            if (!$user) {
                return makeJSONResponse(false, trans('member.member_not_exists'));
            }

            $before = new \Carbon\Carbon();
            $before->subMinute(1);
            $now = new \Carbon\Carbon();
            $start = new \Carbon\Carbon();
            $start->startOfDay();
            $end = new \Carbon\Carbon();
            $end->endOfDay();

            //Find the contact number/IP request exists, 1 request per minute
            $exts1 = UserResetVerifications::where(function ($q) use ($contact_number, $request, $user) {
                $q->where('contact_number', '=', $contact_number)
                    ->orWhere('ip_address', '=', $request->getClientIp())
                    ->orWhere('user_id', '=', $user->id);
            })->whereBetween('created_at', [$before, $now])->count();

            if ($exts1 >= 1) {
                return makeJSONResponse(false, trans('member.verification_limit_per_minute'));
            }

            //Find the contact number/IP request exists, 10 request per day
            $exts2 = UserResetVerifications::where(function ($q) use ($contact_number, $request, $user) {
                $q->where('contact_number', '=', $contact_number)
                    ->orWhere('ip_address', '=', $request->getClientIp())
                    ->orWhere('user_id', '=', $user->id);
            })->whereBetween('created_at', [$start, $end])->count();

            if ($exts2 >= 10) {
                return makeJSONResponse(false, trans('member.verification_code_limit_per_day'));
            }

            $model = new UserResetVerifications();
            $model->user_id = $user->id;
            $model->contact_number = $contact_number;
            $model->code = generateSmsCode(4);
            $model->ip_address = $request->getClientIp();
            $model->status = UserContactVerifications::STATUS_UNUSED;

            $content = ['code' => $model->code];

            if ($model->save()) {
                $result = $this->sms->send($model->contact_number, config('env.ALISMS_SIGNATURE_NAME'), json_encode($content), config('env.ALISMS_TEMPLATE_NAME_FOR_RESET'));
                return makeJSONResponse(true, trans('member.request_verification_code_successfully'));
            } else {
                return makeJSONResponse(false, trans('member.request_verification_code_error'));
            }
        } else {
            return makeJSONResponse(false, trans('validation.is_china_mobile'));
        }
    }

    public function getVerificationSms(Request $request) {
        $contact_number = $request->get('contact_number');
        if (isChinaMobile($contact_number)) {
            $before = new \Carbon\Carbon();
            $before->subMinute(1);
            $now = new \Carbon\Carbon();
            $start = new \Carbon\Carbon();
            $start->startOfDay();
            $end = new \Carbon\Carbon();
            $end->endOfDay();

            //Find the contact number/IP request exists, 1 request per minute
            $exts1 = UserContactVerifications::where(function ($q) use ($contact_number, $request) {
                $q->where('contact_number', '=', $contact_number)
                    ->orWhere('ip_address', '=', $request->getClientIp());
            })->whereBetween('created_at', [$before, $now])->count();

            if ($exts1 >= 1) {
                return makeJSONResponse(false, trans('member.verification_limit_per_minute'));
            }

            //Find the contact number/IP request exists, 10 request per day
            $exts2 = UserContactVerifications::where(function ($q) use ($contact_number, $request) {
                $q->where('contact_number', '=', $contact_number)
                    ->orWhere('ip_address', '=', $request->getClientIp());
            })->whereBetween('created_at', [$start, $end])->count();

            if ($exts2 >= 10) {
                return makeJSONResponse(false, trans('member.verification_code_limit_per_day'));
            }

            $model = new UserContactVerifications();
            $model->contact_number = $contact_number;
            $model->code = generateSmsCode(4);
            $model->ip_address = $request->getClientIp();
            $model->status = UserContactVerifications::STATUS_UNUSED;

            $content = ['code' => $model->code];
            
            if ($model->save()) {
                $result = $this->sms->send($model->contact_number, config('env.ALISMS_SIGNATURE_NAME'), json_encode($content), config('env.ALISMS_TEMPLATE_NAME_FOR_REGISTER'));
                return makeJSONResponse(true, trans('member.request_verification_code_successfully'));
            } else {
                return makeJSONResponse(false, trans('member.request_verification_code_error'));
            }
        } else {
            return makeJSONResponse(false, trans('validation.is_china_mobile'));
        }
    }

    public function weiboLogin(Request $request) {
        return \Socialize::driver('weibo')->redirect();
    }

    public function weiboCallback(Request $request) {
        $oauthUser = \Socialize::driver('weibo')->user();

//        $client = new \GuzzleHttp\Client();
//        dd($oauthUser);
//        $res = $client->request('GET', 'https://api.weibo.com/2/account/profile/email.json', [
//            'query' => ['access_token' => $oauthUser->token]
//        ]);
//        dd($res);

//        var_dump($oauthUser->getId());
//        var_dump($oauthUser->getNickname());
//        var_dump($oauthUser->getName());
//        var_dump($oauthUser->getEmail());
//        var_dump($oauthUser->getAvatar());
//        die;

        //Search if oauthUser->id exists in users table? if yes do login, no do binding(register)
        $user = User::where('weibo_open_id', '=', $oauthUser->id);

        if ($user->exists()) {
            \Auth::guard('users')->login($user->first());
            User::checkAndSaveLocation();
            return redirect()->route('home');
        } else {
            $request->session()->put('weibo_open_id', $oauthUser->id);
            return view('auth.register', ['oauthUser' => $oauthUser, 'weiboLogin' => true]);
        }
    }

    public function qqLogin(Request $request) {
        return \Socialize::driver('qq')->redirect();
    }

    public function qqCallback(Request $request) {
        $oauthUser = \Socialize::driver('qq')->user();

        //Search if oauthUser->id exists in users table? if yes do login, no do binding(register)
        $user = User::where('qq_open_id', '=', $oauthUser->id);

        if ($user->exists()) {
            \Auth::guard('users')->login($user->first());
            User::checkAndSaveLocation();
            return redirect()->route('home');
        } else {
            $request->session()->put('qq_open_id', $oauthUser->id);
            return view('auth.register', ['oauthUser' => $oauthUser, 'qqLogin' => true]);
        }
    }

    public function weixinLogin(Request $request) {
        return \Socialize::driver('weixin')->redirect();
    }

    public function weixinCallback(Request $request) {
        $oauthUser = \Socialize::driver('weixin')->user();
        
        //Search if oauthUser->id exists in users table? if yes do login, no do binding(register)
        $user = User::where('weixin_open_id', '=', $oauthUser->id);

        if ($user->exists()) {
            \Auth::guard('users')->login($user->first());
            User::checkAndSaveLocation();
            return redirect()->route('home');
        } else {
            $request->session()->put('weixin_open_id', $oauthUser->id);
            return view('auth.register', ['oauthUser' => $oauthUser, 'weixinLogin' => true]);
        }
    }

    public function weixinwebLogin(Request $request) {
        return \Socialize::driver('weixinweb')->redirect();
    }

    public function weixinwebCallback(Request $request) {
        $oauthUser = \Socialize::driver('weixinweb')->user();

        //Search if oauthUser->id exists in users table? if yes do login, no do binding(register)
        $user = User::where('weixin_open_id', '=', $oauthUser->id);

        if ($user->exists()) {
            \Auth::guard('users')->login($user->first());
            User::checkAndSaveLocation();
            return redirect()->route('home');
        } else {
            $request->session()->put('weixin_open_id', $oauthUser->id);
            return view('auth.register', ['oauthUser' => $oauthUser, 'weixinLogin' => true]);
        }
    }
}
