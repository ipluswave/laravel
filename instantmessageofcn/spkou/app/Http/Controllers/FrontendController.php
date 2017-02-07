<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App;

class FrontendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
//        App::setLocale('cn');
    }

    public function getBankLists() {
        $banks = \App\Models\Bank::getBankLists();

        view()->share('banks', $banks);
    }

    public function getUserBanks() {
        \Auth::guard('users')->user()->load(['bankAccount', 'bankAccount.bank']);
    }
}
