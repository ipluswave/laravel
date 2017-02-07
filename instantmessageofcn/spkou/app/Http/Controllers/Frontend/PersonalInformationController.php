<?php

namespace App\Http\Controllers\Frontend;

use Carbon;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\PersonalInformationUpdateFormRequest;
use App\Models\Region;
use App\Models\User;

class PersonalInformationController extends FrontendController
{
    public function index(Request $request) {
        $province = Region::getRegion()->where('parent_id', '=', 1)->get();
        $provinces = array();
        $cities = array();
        $areas = array();
        foreach ($province as $key => $var) {
            $provinces[$var->id] = $var->getName();
        }

        $me = \Auth::guard('users')->user();
        if ($me->province_id != null) {
            $c = Region::getRegion()->where('parent_id', '=', $me->province_id)->get();
            $cities = array();
            foreach ($c as $key => $var) {
                $cities[$var->id] = $var->getName();
            }
        }

        if ($me->city_id != null) {
            $a = Region::getRegion()->where('parent_id', '=', $me->city_id)->get();
            $areas = array();
            foreach ($a as $key => $var) {
                $areas[$var->id] = $var->getName();
            }
        }
        return view('frontend.personalInformation.index', ['provinces' => $provinces, 'cities' => $cities, 'areas' => $areas]);
    }

    public function update(PersonalInformationUpdateFormRequest $request)
    {
        try {
            $model = \Auth::guard('users')->user();
            if ($request->hasFile('avatar')) {
                $extension = $request->file('avatar')->getClientOriginalExtension();
                $size = $request->file('avatar')->getSize();

                if (in_array(strtolower($extension), ['png', 'jpg', 'jpeg', 'gif']) && $size <= 800000) {
                    $model->img_avatar = $request->file('avatar');
                } else {
                    return makeResponse(trans('member.avatar_image_type'), true);
                }
            }

            if ($request->has('email_address') && $request->get('email_address') != '' && filter_var($request->get('email_address'), FILTER_VALIDATE_EMAIL)) {
                $exists = User::where('email_address', '=', $request->get('email_address'))->where('id', '!=', $model->id)->exists();

                if ($exists) {
                    return makeResponse(trans('member.email_exists'), true);
                }

                $model->email_address = $request->get('email_address');
            }

            if ($model->is_validated == 0) {
                $model->real_name = $request->get('real_name');
            }

            //Check if the province is valid
            if ($request->has('province')) {
                $province = Region::find($request->get('province'));
                //1 is china
                if (!$province || $province->parent_id != 1) {
                    return makeResponse(trans('member.invalid_province'), true);
                }

                $model->province = $province->region_name;
                $model->province_en = $province->region_name_en;
                $model->province_id = $province->id;
            }

            //Check if the city is valid
            if (isset($province) && $request->has('city')) {
                $city = Region::find($request->get('city'));

                if (!$city || $city->parent_id != $province->id) {
                    return makeResponse(trans('member.invalid_city'), true);
                }

                $model->city = $city->region_name;
                $model->city_en = $city->region_name_en;
                $model->city_id = $city->id;
            }

            //Check if the area is valid
            if (isset($province) && isset($city) && $request->has('area')) {
                $area = Region::find($request->get('area'));

                if (!$area || $area->parent_id != $city->id) {
                    return makeResponse(trans('member.invalid_area'), true);
                }

                $model->area = $area->region_name;
                $model->area_en = $area->region_name_en;
                $model->area_id = $area->id;
            }

            if ($request->has('introduce_self') && $request->get('introduce_self') != '') {
                $model->introduce_self = strip_tags($request->get('introduce_self'));
            }

            $model->gender = $request->get('gender');

            $model->save();

            addSuccess(trans('member.successfully_update_personal_information'));
            return makeResponse(trans('member.successfully_update_personal_information'));
        } catch (\Exception $e) {
            return makeResponse($e->getMessage(), true);
        }
    }

    public function getCity(Request $request) {
        $model = Region::getRegion()->where('parent_id', '=', $request->get('province'))->get();
        $city = array();
        foreach ($model as $key => $var) {
            $city[$var->id] = $var->getName();
        }

        return makeJSONResponse(true, 'Success', ['city' => $city]);
    }

    public function getArea(Request $request) {
        $model = Region::getRegion()->where('parent_id', '=', $request->get('city'))->get();
        $area = array();
        foreach ($model as $key => $var) {
            $area[$var->id] = $var->getName();
        }

        return makeJSONResponse(true, 'Success', ['area' => $area]);
    }
}