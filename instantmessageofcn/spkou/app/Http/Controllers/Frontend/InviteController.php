<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

class InviteController extends FrontendController
{
    public function index(Request $request) {
        return view('frontend.invite.index');
    }
}