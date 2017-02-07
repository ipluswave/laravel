<?php

namespace App\Http\Controllers\Backend;

use Auth;
use Input;
use Datatables;
use Validator;
use DB;
use Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BackendController;
use App\Models\Withdraw;

class WithdrawController extends BackendController
{
    public function index(Request $request) {
        return view('backend.withdraw.index');
    }

    public function indexDt(Request $request) {
        $model = Withdraw::GetWithdraw()->where('status', 0);

        return Datatables::of($model)
            ->filter(function ($model) {
                return $model->GetFilteredResults();
            })
			->addColumn('email', function ($model) {
				return $model->getOwnerEmail();
			})
            ->addColumn('actions', function ($model) {
                $actions = buildConfirmationLinkHtml([
                    'url' => route('backend.withdraw.approve', ['request_id' => $model->id]),
                    'description' => '<i class="fa fa-check"></i>',
                ]);
                $actions .= buildConfirmationLinkHtml([
                    'url' => route('backend.withdraw.reject', ['request_id' => $model->id]),
                    'description' => '<i class="fa fa-remove"></i>',
                ]);
                return $actions;
            })
            ->make(true);
    }

	public function approve($id) {
        $model = Withdraw::find($id);
		$model->status = 1;

        try {
            if ($model->save()) {
                return makeResponse('成功删除会员');
            } else {
                throw new \Exception('未能删除会员，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
	
	public function reject($id) {
        $model = Withdraw::find($id);
		$model->status = 2;

        try {
            if ($model->save()) {
                return makeResponse('成功删除会员');
            } else {
                throw new \Exception('未能删除会员，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
}
