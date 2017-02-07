<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Response;
use Auth;

class UserChatMessageCreateFormRequest extends FormRequest
{
    protected $rules = [
        'receiver'      => 'required|exists:users,id',
        'message'       => 'required'
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