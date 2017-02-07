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
use App\Models\RawMaterial;
use App\Http\Requests\Backend\RawMaterialCreateFormRequest;
use App\Http\Requests\Backend\RawMaterialEditFormRequest;

class RawMaterialController extends BackendController
{
    public function index(Request $request, $id = null) {
        return view('backend.rawmaterial.index');
    }

    public function indexDt(Request $request, $id = null) {
        $model = RawMaterial::GetMaterial();

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
                    'url' => route('backend.rawmaterial.edit', ['id' => $model->id]),
                    'description' => '<i class="fa fa-pencil"></i>',
                    'modal' => '#remote-modal',
                ]);
                $actions .= buildConfirmationLinkHtml([
                    'url' => route('backend.rawmaterial.delete', ['id' => $model->id]),
                    'description' => '<i class="fa fa-trash"></i>',
                    'title' => '确认删除？',
                    'content' => '确认删除此原材料？'
                ]);
                return $actions;
            })
            ->make(true);
    }

    public function create(Request $request) {
        return view('backend.rawmaterial.create');
    }

    public function createPost(RawMaterialCreateFormRequest $request, $id = null) {
        try {
            $model = new RawMaterial();
            $model->name_cn = $request->get('name_cn');
            $model->name_en = $request->get('name_en');

            $model->save();
            return makeResponse('成功新增原材料');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function edit($id) {
        $model = RawMaterial::GetMaterial()->find($id);

        return view('backend.rawmaterial.edit', ['model' => $model]);
    }

    public function editPost(RawMaterialEditFormRequest $request, $id) {
        $model = RawMaterial::GetMaterial()->find($id);

        if (!$model) {
            return makeResponse('原材料不存在', true);
        }

        try {
            $model->name_cn = $request->get('name_cn');
            $model->name_en = $request->get('name_en');

            $model->save();
            return makeResponse('成功编辑原材料');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function delete($id) {
        $model = RawMaterial::GetMaterial()->find($id);

        try {
            if ($model->delete()) {
                return makeResponse('成功删除原材料');
            } else {
                throw new \Exception('未能删除原材料，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
}
