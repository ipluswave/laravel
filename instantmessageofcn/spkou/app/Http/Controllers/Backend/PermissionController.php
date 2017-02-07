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
use App\Models\PermissionGroup;
use App\Models\PermissionGroupPermission;
use App\Http\Requests\Backend\PermissionGroupCreateFormRequest;
use App\Http\Requests\Backend\PermissionGroupEditFormRequest;

class PermissionController extends BackendController
{
    public function index(Request $request) {
        return view('backend.permission.index');
    }

    public function indexDt(Request $request) {
        $model = PermissionGroup::with(['permissions'])->GetGroups();

        return Datatables::of($model)
//            ->editColumn('blabla', function ($model) {
//
//            })
//            ->addColumn('blabla2', function ($model) {
//
//            })
            ->filter(function ($model) {
                return $model->GetFilteredResults();
            })
            ->addColumn('actions', function ($model) {
                $actions = '<a href="' . route('backend.permissions.edit', ['id' => $model->id]) . '" class="btn btn-xs blue"><i class="fa fa-pencil"></i></a>';
                $actions .= buildConfirmationLinkHtml([
                    'url' => route('backend.permissions.delete', ['id' => $model->id]),
                    'description' => '<i class="fa fa-trash"></i>',
                ]);
                return $actions;
            })
            ->make(true);
    }

    public function create(Request $request) {
        return view('backend.permission.create');
    }

    public function createPost(PermissionGroupCreateFormRequest $request) {
        $group = new PermissionGroup();
        $group->group_name = $request->get('group_name');

        $permissions = array();
        foreach ($request->get('permissions') as $key => $var) {
            $p = new PermissionGroupPermission();
            $p->permission_tag = $var;

            $permissions[] = $p;
        }

        try {
            DB::beginTransaction();

            if (count($permissions) < 1) {
                throw new \Exception('请至少选择一个权限');
            }

            $group->save();
            if (!$group->permissions()->saveMany($permissions)) {
                throw new \Exception('当前无法新增权限组，请稍后再试');
            }

            DB::commit();
            addSuccess('成功新增权限组');
            return makeResponse('成功新增权限组');
        } catch (\Exception $e) {
            DB::rollback();
            return makeResponse($e->getMessage(), true);
        }
    }

    public function edit($id) {
        $model = PermissionGroup::with(['permissions'])->find($id);
        $permissions = array();
        foreach ($model->permissions as $key => $var) {
            $permissions[] = $var->permission_tag;
        }

        return view('backend.permission.edit', ['model' => $model, 'permissions' => $permissions]);
    }

    public function editPost(PermissionGroupEditFormRequest $request, $id) {
        $group = PermissionGroup::with(['permissions'])->find($id);

        try {
            DB::beginTransaction();
            $group->group_name = $request->get('group_name');

            $permissions = array();
            foreach ($request->get('permissions') as $key => $var) {
                $p = new PermissionGroupPermission();
                $p->permission_tag = $var;

                $permissions[] = $p;
            }

            if (count($permissions) < 1) {
                throw new \Exception('请至少选择一个权限');
            }

            if (!$group->permissions()->delete()) {
                throw new \Exception('当前无法新增权限组，请稍后再试');
            }

            if (!$group->permissions()->saveMany($permissions)) {
                throw new \Exception('当前无法新增权限组，请稍后再试');
            }

            DB::commit();
            addSuccess('成功修改权限组');
            return makeResponse('成功修改权限组');
        } catch (\Exception $e) {
            DB::rollback();
            return makeResponse($e->getMessage(), true);
        }
    }

    public function delete($id) {
        $group = PermissionGroup::with(['permissions'])->find($id);

        try {
            if ($group->delete()) {
                addSuccess('成功删除权限组');
                return makeResponse('成功删除权限组');
            } else {
                throw new \Exception('当前无法删除权限组，请稍后再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
}
