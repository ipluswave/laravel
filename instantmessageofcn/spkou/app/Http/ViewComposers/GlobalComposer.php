<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class GlobalComposer {

    protected $_G;

    public function __construct()
    {
        $actions = \Route::current()->getAction();

        $this->_G = array();

        if (isset($actions) && isset($actions['disable_sidemenu'])) {
            $this->_G['disable_sidemenu'] = $actions['disable_sidemenu'];
        }

        if (\Route::current()->getName()) {
            $this->_G['route_name'] = \Route::current()->getName();
        }

        if (\Auth::guard('users')->check()) {
            $this->_G['user'] = \Auth::guard('users')->user();
        } else {
            $this->_G['user'] = null;
        }

        if(preg_match('/micromessenger/i', strtolower(request()->header('User-Agent')))) {
            $this->_G['is_weixin_browser'] = true;
        }
    }

    public function compose(View $view)
    {
        $view->with('_G', $this->_G);
    }

}