<?php
namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

class SystemMessageController extends FrontendController
{
    public function index(Request $request) {
        return view('frontend.systemmessage.index');
    }
}