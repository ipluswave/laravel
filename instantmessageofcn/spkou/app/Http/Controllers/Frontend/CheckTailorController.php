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

class CheckTailorController extends FrontendController
{
    public function index(Request $request, $id)
    {
        $tailor = User::with(['skills', 'skills.category'])->find($id);

        return view('frontend.includes.modalTailorDetail', ['tailor' => $tailor]);
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