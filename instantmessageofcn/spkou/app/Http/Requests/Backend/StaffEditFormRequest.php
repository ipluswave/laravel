<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Response;
use Auth;

class StaffEditFormRequest extends FormRequest
{
    protected $rules = [
        'username' => 'required|min:1|max:64|notEmail|alpha_num',
        'email' => 'required|email',
        'name' => 'required',
        'password' => 'isPassword|confirmed',
        'permission_group_id' => 'exists:permission_groups,id',
    ];

    public function rules()
    {
        $rules = $this->rules;

        return $rules;
    }

    public function authorize()
    {
        return Auth::guard('staff')->check() && Auth::guard('staff')->user()->hasPermission('manage_staff');
    }

    // OPTIONAL OVERRIDE
    public function forbiddenResponse()
    {
        return Response::make('Permission denied!', 403);
    }

    // OPTIONAL OVERRIDE
//    public function response()
//    {
//        // If you want to customize what happens on a failed validation,
//        // override this method.
//        // See what it does natively here:
//        // https://github.com/laravel/framework/blob/master/src/Illuminate/Foundation/Http/FormRequest.php
//    }
}