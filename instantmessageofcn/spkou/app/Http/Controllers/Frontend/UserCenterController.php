<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\UserBankAccountCreateFormRequest;
use App\Models\Bank;
use App\Models\UserBank;
use Auth;

class UserCenterController extends FrontendController
{
    public function index(Request $request) {
        return view('frontend.userCenter.index');
    }
}