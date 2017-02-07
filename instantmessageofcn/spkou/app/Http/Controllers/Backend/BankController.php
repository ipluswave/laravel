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
use App\Models\Bank;
use App\Http\Requests\Backend\BankCreateFormRequest;
use App\Http\Requests\Backend\BankEditFormRequest;

class BankController extends BackendController
{
    public function index(Request $request, $id = null) {
        return view('backend.bank.index');
    }

    public function indexDt(Request $request, $id = null) {
        $model = Bank::GetBank();

        return Datatables::of($model)
//            ->editColumn('blabla', function ($model) {
//
//            })
//            ->addColumn('blabla2', function ($model) {
//
//            })
            ->addColumn('names', function ($model) {
                return $model->getNames();
            })
            ->filter(function ($model) {
                return $model->GetFilteredResults();
            })
            ->addColumn('actions', function ($model) {
                $actions = '';
                $actions .= buildRemoteLinkHtml([
                    'url' => route('backend.bank.edit', ['id' => $model->id]),
                    'description' => '<i class="fa fa-pencil"></i>',
                    'modal' => '#remote-modal',
                ]);
                $actions .= buildConfirmationLinkHtml([
                    'url' => route('backend.bank.delete', ['id' => $model->id]),
                    'description' => '<i class="fa fa-trash"></i>',
                    'title' => '确认删除？',
                    'content' => '确认删除此银行？'
                ]);
                return $actions;
            })
            ->make(true);
    }

    public function create(Request $request) {
        return view('backend.bank.create');
    }

    public function createPost(BankCreateFormRequest $request, $id = null) {
        try {
            $model = new Bank();
            $model->name_cn = $request->get('name_cn');
            $model->name_en = $request->get('name_en');
            $model->background_color = $request->get('background_color');
            $model->font_color = $request->get('font_color');
            $model->logo = $request->file('logo');

            $model->save();
            return makeResponse('成功新增银行');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function edit($id) {
        $model = Bank::GetBank()->find($id);

        return view('backend.bank.edit', ['model' => $model]);
    }

    public function editPost(BankEditFormRequest $request, $id) {
        $model = Bank::GetBank()->find($id);

        if (!$model) {
            return makeResponse('银行不存在', true);
        }

        try {
            $model->name_cn = $request->get('name_cn');
            $model->name_en = $request->get('name_en');
            $model->background_color = $request->get('background_color');
            $model->font_color = $request->get('font_color');
            if ($request->hasFile('logo')) {
                $model->logo = $request->file('logo');
            }

            $model->save();
            return makeResponse('成功编辑银行');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function delete($id) {
        $model = Bank::GetBank()->find($id);

        try {
            if ($model->delete()) {
                return makeResponse('成功删除银行');
            } else {
                throw new \Exception('未能删除银行，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
}
