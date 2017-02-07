<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Response;
use Auth;

class PersonalInformationUpdateFormRequest extends FormRequest
{
    protected $rules = [
        'email_address' => 'email',
        'avatar' => '',
        'province' => 'exists:region,id',
        'city' => 'exists:region,id',
        'area' => 'exists:region,id',
        'gender' => 'isGender'
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