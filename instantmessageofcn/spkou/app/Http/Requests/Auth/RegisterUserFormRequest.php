<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Response;
use Auth;

class RegisterUserFormRequest extends FormRequest
{
    protected $rules = [
        'contact_number' => 'required|isChinaMobile|unique:users,contact_number',
        'password' => 'required|min:6|confirmed',
        'password_confirmation' => 'required|min:6',
        'code' => 'required|min:4',
    ];

    public function rules()
    {
        $rules = $this->rules;

        return $rules;
    }

    public function authorize()
    {
        return Auth::guest();
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