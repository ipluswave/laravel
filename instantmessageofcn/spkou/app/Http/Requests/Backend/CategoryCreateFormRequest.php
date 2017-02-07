<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Response;
use Auth;

class CategoryCreateFormRequest extends FormRequest
{
    protected $rules = [
        'title_cn' => 'required|min:1|max:255',
        'title_en' => 'required|min:1|max:255',
        'selectable' => 'required|in:0,1'
    ];

    public function rules()
    {
        $rules = $this->rules;

        return $rules;
    }

    public function authorize()
    {
        return Auth::guard('staff')->check() && Auth::guard('staff')->user()->hasPermission('manage_category');
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