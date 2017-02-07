<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;

class EtcController extends Controller
{
    public function setLang(Request $request, $lang) {
        if (in_array($lang, config('app.locales'))) {
            Session::put('lang', $lang);
        } else {
            //Set back to default lang
            Session::put('lang', config('app.fallback_locale'));
        }

        $redirect = $request->get('redirect');

        if (isset($redirect) && $redirect != '' && $redirect != null) {
            return redirect()->to($redirect);
        } else {
            return redirect()->to('/');
        }
    }
}


