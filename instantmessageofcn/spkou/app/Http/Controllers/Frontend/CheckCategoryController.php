<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use App\Models\User;
use Input;
use Validator;
use Illuminate\Http\Request;
use Auth;
use Image;
use File;
use App\Models\Category;

class CheckCategoryController extends FrontendController
{
    public function levelTwo(Request $request)
    {
        $category = Category::where('parent_id', '=', $request->get('parent_id'))->get();
        $categories = array();
        foreach ($category as $key => $var) {
            $categories[$var->id] = $var->getTitle();
        }

        if (count($categories) > 0) {
            return makeJSONResponse(true, 'Category found', ['category' => $categories]);
        } else {
            return makeJSONResponse(false, 'Category not found');
        }
    }

    public function levelThree(Request $request)
    {
        $category = Category::where('parent_id', '=', $request->get('parent_id'))->get();
        $categories = array();
        foreach ($category as $key => $var) {
            $categories[$var->id] = $var->getTitle();
        }

        if (count($categories) > 0) {
            return makeJSONResponse(true, 'Category not found', ['category' => $categories]);
        } else {
            return makeJSONResponse(true, 'No sub category, selectable', ['selectable' => 1]);
        }
    }
}