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
use App\Models\Category;
use App\Http\Requests\Backend\CategoryCreateFormRequest;
use App\Http\Requests\Backend\CategoryEditFormRequest;

class CategoryController extends BackendController
{
    public function index(Request $request, $id = null) {
        $model = null;

        if ($id !== null) {
            $model = Category::with(['parent'])->find($id);
        }
        
        return view('backend.category.index', ['id' => $id, 'model' => $model]);
    }

    public function indexDt(Request $request, $id = null) {
        $model = Category::GetCategory();

        if ($id === null) {
            $model = $model->whereNull('parent_id');
        } else {
            $model = $model->where('parent_id', '=', $id);
        }

        return Datatables::of($model)
//            ->editColumn('blabla', function ($model) {
//
//            })
//            ->addColumn('blabla2', function ($model) {
//
//            })
            ->addColumn('titles', function ($model) {
                return $model->getTitles();
            })
            ->filter(function ($model) {
                return $model->GetFilteredResults();
            })
            ->addColumn('actions', function ($model) {
                $actions = '';
                if ($model->level == 1 || $model->level == 2) {
                    $actions .= '<a href="' . route('backend.category', ['id' => $model->id]) . '" class="btn btn-xs purple"><i class="fa fa-bookmark-o"></i></a>';
                }
                $actions .= buildRemoteLinkHtml([
                    'url' => route('backend.category.edit', ['id' => $model->id]),
                    'description' => '<i class="fa fa-pencil"></i>',
                    'modal' => '#remote-modal',
                ]);
                $actions .= buildConfirmationLinkHtml([
                    'url' => route('backend.category.delete', ['id' => $model->id]),
                    'description' => '<i class="fa fa-trash"></i>',
                    'title' => '确认删除？',
                    'content' => '确认删除？所有子目录也会同时被删除'
                ]);
                return $actions;
            })
            ->make(true);
    }

    public function create(Request $request, $id = null) {
        $model = null;
        if ($id != null) {
            $model = Category::find($id);
        }
        return view('backend.category.create', ['id' => $id, 'model' => $model]);
    }

    public function createPost(CategoryCreateFormRequest $request, $id = null) {
        try {
            $model = new Category();
            $model->title_cn = $request->get('title_cn');
            $model->title_en = $request->get('title_en');
            $model->selectable = $request->get('selectable');

            if ($id != null && $id > 0) {
                $parent = Category::find($id);

                if ($parent) {
                    $model->parent_id = $parent->id;
                    $next_level = $parent->level + 1;
                    if (in_array($next_level, [1, 2, 3])) {
                        $model->level = $next_level;
                    } else {
                        return makeResponse('目录等级设置不正确', true);
                    }
                } else {
                    return makeResponse('上级目录不存在', true);
                }
            } else {
                $model->level = 1;
            }

            $model->save();
            return makeResponse('成功新增目录');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function edit($id) {
        $model = Category::GetCategory()->find($id);

        return view('backend.category.edit', ['model' => $model]);
    }

    public function editPost(CategoryEditFormRequest $request, $id) {
        $model = Category::GetCategory()->find($id);

        if (!$model) {
            return makeResponse('目录不存在', true);
        }

        try {
            $model->title_cn = $request->get('title_cn');
            $model->title_en = $request->get('title_en');
            $model->selectable = $request->get('selectable');

            $model->save();
            return makeResponse('成功编辑目录');
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function delete($id) {
        $model = Category::GetCategory()->with(['children', 'children.children'])->find($id);

        try {
            if ($model->children) {
                foreach ($model->children as $key => $var) {
                    if ($var->children) {
                        foreach ($var->children as $k => $v) {
                            $v->delete();
                        }
                    }

                    $var->delete();
                }
            }
            if ($model->delete()) {
                return makeResponse('成功删除目录');
            } else {
                throw new \Exception('未能删除目录，请稍候再试');
            }
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }
}
