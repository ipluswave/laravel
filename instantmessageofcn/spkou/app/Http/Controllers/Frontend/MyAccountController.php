<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\UserBankAccountCreateFormRequest;
use App\Models\Bank;
use App\Models\UserBank;
use Auth;

class MyAccountController extends FrontendController
{
    public function index(Request $request) {
        $this->getBankLists();
        $this->getUserBanks();
        return view('frontend.myAccount.index');
    }

    public function create(UserBankAccountCreateFormRequest $request) {
        $bank = new UserBank();
        $bank->user_id = Auth::guard('users')->user()->id;
        $bank->bank_id = $request->bank_id;
        $bank->account_name = $request->get('account_name');
        $bank->account_number = $request->get('account_number');
        $bank->account_address = $request->get('account_address');

        try {
            $bank->save();
            addSuccess(trans('member.bank_account_successfully_add'));
            return makeResponse(trans('member.bank_account_successfully_add'));
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), false);
        }
    }

    public function delete(Request $request, $id) {
        $model = UserBank::find($id);

        if ($model) {
            if ($model->user_id == Auth::guard('users')->user()->id) {
                $model->delete();
                addSuccess(trans('member.bankcard_successfully_delete'));
                return makeResponse(trans('member.bankcard_successfully_delete'));
            } else {
                return makeResponse(trans('member.bankcard_not_belongs_to_you'), true);
            }
        } else {
            return makeResponse(trans('member.bankcard_not_found'), true);
        }
    }
}