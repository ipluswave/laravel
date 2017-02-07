<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\UserSkill;

class SkillVerificationController extends FrontendController
{
    public function index(Request $request) {
        $category = Category::whereNull('parent_id')->get();
        $categories = array();
        foreach ($category as $key => $var) {
            $categories[$var->id] = $var->getTitle();
        }
        $mySkills = UserSkill::with('category')->where('user_id', '=', \Auth::guard('users')->user()->id)->get();

        return view('frontend.skillVerification.index', ['category' => $categories, 'mySkills' => $mySkills]);
    }

    public function update(Request $request) {
        $categories = explode(',', $request->get('skills'));

        try {
            \DB::beginTransaction();

            $user = \Auth::guard('users')->user();

            if (count($categories) > 0 && count($categories) <= 6) {
                //Delete the user current skill set
                \DB::table('user_skill')->where('user_id', '=', $user->id)->delete();

                //Loop and insert the categories
                foreach ($categories as $key => $var) {
                    $category = Category::find($var);
                    if ($category->parent_id == null) {
                        throw new \Exception(trans('order.cannot_set_first_level_as_skill'));
                    }

                    if ($category->children->count()) {
                        throw new \Exception(trans('order.only_last_level_category_is_skill'));
                    }

                    $c = new UserSkill();
                    $c->user_id = $user->id;
                    $c->category_id = $category->id;

                    if (!$c->save()) {
                        throw new \Exception(trans('common.unknown_error'));
                    }
                }
            }

            $user->experience = $request->has('working_experience') && isNumber($request->get('working_experience')) ? $request->get('working_experience') : 0;

            if (!$user->save()) {
                return makeJSONResponse(trans('common.unknown_error'), true);
            }
            \DB::commit();
            return makeResponse(trans('order.successfully_update_skill'));
        } catch (\Exception $e) {
            \DB::rollback();
            return makeJSONResponse($e->getMessage(), true);
        }
    }
}