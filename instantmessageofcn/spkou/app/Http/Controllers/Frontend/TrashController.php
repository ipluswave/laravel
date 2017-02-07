<?php
namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;

class TrashController extends FrontendController
{
    public function index(Request $request) {
        return view('frontend.trash.index');
    }
}