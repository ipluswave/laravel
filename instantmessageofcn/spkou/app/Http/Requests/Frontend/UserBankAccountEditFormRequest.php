<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Response;
use Auth;

class UserBankAccountEditFormRequest extends FormRequest
{
    protected $rules = [
        'bank_id' => 'required|exists:bank,id',
        'account_name' => 'required|min:1|max:255',
        'account_number' => 'required|min:1|max:255|isNumber',
        'account_address' => 'required|min:1|max:255',
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