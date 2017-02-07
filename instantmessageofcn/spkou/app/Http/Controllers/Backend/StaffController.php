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
use App\Models\Staff;
use App\Http\Requests\Backend\StaffCreateFormRequest;
use App\Http\Requests\Backend\StaffEditFormRequest;

class StaffController extends BackendController
{
    public function index(Request $request) {
        return view('backend.staff.index');
    }

    public function indexDt(Request $request) {
        $model = Staff::with(['permissionGroup'])->GetStaff();

        return Datatables::of($model)
//            ->editColumn('blabla', function ($model) {
//
//            })
//            ->addColumn('blabla2', function ($model) {
//
//            })
            ->addColumn('group', function ($model) {
                if ($model->permissionGroup) {
                    return $model->permissionGroup->group_name;
                } else {
                    return '-';
                }
            })
            ->filter(function ($model) {
                return $model->GetFilteredResults();
            })
            ->addColumn('actions', function ($model) {
                $actions = buildRemoteLinkHtml([
                    'url' => route('backend.staff.edit', ['id' => $model->id]),
                    'description' => '<i class="fa fa-pencil"></i>',
                    'modal' => '#remote-modal',
                ]);
                $actions .= buildConfirmationLinkHtml([
                    'url' => route('backend.staff.delete', ['id' => $model->id]),
                    'description' => '<i class="fa fa-trash"></i>',
                ]);
                return $actions;
            })
            ->make(true);
    }

    public function create(Request $request) {
        $permissions = PermissionGroup::lists('group_name', 'id');
        return view('backend.staff.create', ['permissions' => $permissions]);
    }

    public function createPost(StaffCreateFormRequest $request) {
        try {
            $model = new Staff();
            $model->username = $request->get('username');
            $model->email = $request->get('email');
            $model->name = $request->get('name');
            $model->password = $request->get('password');
            $model->staff_type = Staff::defaultUserType();
            $model->permission_group_id = $request->get('permission_group_id');

            $model->save();
            return makeResponse('成功新增操作员');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function edit($id) {
        $model = Staff::with(['permissionGroup'])->getStaff()->where('id', '=', $id)->first();
        $permissions = PermissionGroup::lists('group_name', 'id');

        return view('backend.staff.edit', ['model' => $model, 'permissions' => $permissions]);
    }

    public function editPost(StaffEditFormRequest $request, $id) {
        $model = Staff::with(['permissionGroup'])->getStaff()->where('id', '=', $id)->first();

        //Check username availibility
        $username_exists = Staff::where('username', '=', $request->get('username'))->first();
        if ($username_exists && $username_exists->id != $model->id) {
            return makeResponse('登入账号已被注册', true);
        }

        //Check email availibility
        $email_exists = Staff::where('email', '=', $request->get('email'))->first();
        if ($email_exists && $email_exists->id != $model->id) {
            return makeResponse('电子邮件地址已被注册', true);
        }

        //Deny edit for admin account
        if ($model->staff_type != Staff::defaultUserType()) {
            return makeResponse('管理员帐号无法在本页修改', true);
        }

        $model->username = $request->get('username');
        $model->email = $request->get('email');
        $model->name = $request->get('name');
        if ($request->has('password')) {
            $model->password = $request->get('password');
        }
        $model->permission_group_id = $request->get('permission_group_id');

        try {
            $model->save();
            return makeResponse('成功修改操作员资料');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function delete($id) {
        $model = Staff::getStaff()->where('id', '=', $id)->first();

        try {
            if ($model->delete()) {
                return makeResponse('成功删除操作员');
            } else {
                throw new \Exception('当前无法删除操作员，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
}
