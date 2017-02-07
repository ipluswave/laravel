<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Response;
use Auth;

class UserIdentityCreateFormRequest extends FormRequest
{
    protected $rules = [
        'real_name' => 'required',
        'id_card_no' => 'required|min:18',
        'gender' => 'required|in:0,1',
        'address' => 'required|min:1|max:255',
        'date_of_birth' => 'required',
        'address' => 'required',
        'handphone_no' => 'required',
        'id_image_front' => 'required',
        'id_image_back' => 'required',
    ];

    public function rules()
    {
        $rules = $this->rules;

        return $rules;
    }

    public function authorize()
    {
        return Auth::guard('users')->check();
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