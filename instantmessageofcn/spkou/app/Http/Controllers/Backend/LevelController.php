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
use App\Models\Level;
use App\Http\Requests\Backend\LevelCreateFormRequest;
use App\Http\Requests\Backend\LevelEditFormRequest;

class LevelController extends BackendController
{
    public function index(Request $request, $id = null) {
        return view('backend.level.index');
    }

    public function indexDt(Request $request, $id = null) {
        $model = Level::GetLevel();
		
        return Datatables::of($model)
			->addColumn('url_icon', function ($model) {
                return $model->getIcons();
            })
            ->addColumn('actions', function ($model) {
                $actions = '';
                $actions .= buildRemoteLinkHtml([
                    'url' => route('backend.level.edit', ['id' => $model->id]),
                    'description' => '<i class="fa fa-pencil"></i>',
                    'modal' => '#remote-modal',
                ]);
                $actions .= buildConfirmationLinkHtml([
                    'url' => route('backend.level.delete', ['id' => $model->id]),
                    'description' => '<i class="fa fa-trash"></i>',
                    'title' => '确认删除？',
                    'content' => '确认删除此银行？'
                ]);
                return $actions;
            })
            ->make(true);
    }

    public function create(Request $request) {
        return view('backend.level.create');
    }

    public function createPost(LevelCreateFormRequest $request, $id = null) {
        try {
            $model = new Level();
            $model->badge = $request->get('badge');
            $model->level = $request->get('level');
			// $model->url_icon = $request->file('url_icon');
			$path = '';
			$avatar = '';
			if (Input::file('url_icon') !='')
			{
				$file = array('url_icon' => Input::file('url_icon'));
		  		$rules = array('url_icon' => 'mimes:jpeg,bmp,png,gif');
				$validator = Validator::make($file, $rules);
				if ($validator->fails())
		  		{
		  			Session::flash('message', 'Icon invalid');
					Session::flash('flash_type', 'warning');
		  		}
				else
				{
					$destinationPath = 'uploads';
					$extension = Input::file('url_icon')->getClientOriginalExtension();
					$fileName = str_random(100).'.'.$extension;
					Input::file('url_icon')->move($destinationPath, $fileName);
					$path = $destinationPath."/".$fileName;
					$avatar = $path;
				}
			}
			$model->url_icon = $avatar;
			
            $model->save();
            return makeResponse('成功新增银行');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function edit($id) {
        $model = Level::GetLevel()->find($id);

        return view('backend.level.edit', ['model' => $model]);
    }

    public function editPost(LevelEditFormRequest $request, $id) {
        $model = Level::GetLevel()->find($id);

        if (!$model) {
            return makeResponse('银行不存在', true);
        }

        try {
            $model->badge = $request->get('badge');
            $model->level = $request->get('level');
			
			$path = '';
			$avatar = '';
			if (Input::file('url_icon') != '')
			{
				$file = array('url_icon' => Input::file('url_icon'));
		  		$rules = array('url_icon' => 'mimes:jpeg,bmp,png,gif');
				$validator = Validator::make($file, $rules);
				if ($validator->fails())
		  		{
		  			Session::flash('message', 'Icon invalid');
					Session::flash('flash_type', 'warning');
		  		}
				else
				{
					$destinationPath = 'uploads';
					$extension = Input::file('url_icon')->getClientOriginalExtension();
					$fileName = str_random(100).'.'.$extension;
					Input::file('url_icon')->move($destinationPath, $fileName);
					$path = $destinationPath."/".$fileName;
					$avatar = $path;
				}
			}
			else
			{
				$avatar = $request->get('url_icon_hidden');
			}
			$model->url_icon = $avatar;
            $model->save();
            return makeResponse('成功编辑银行');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function delete($id) {
        $model = Level::GetLevel()->find($id);

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
