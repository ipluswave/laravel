<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('isPermissionTag', function($attribute, $value, $parameters) {
            return \App\Models\PermissionGroupPermission::isValidPermission($value);
        });

        Validator::extend('notEmail', function($attribute, $value, $parameters) {
            return !filter_var($value, FILTER_VALIDATE_EMAIL);
        });

        Validator::extend('isPassword', function($attribute, $value, $parameters) {
            return strlen($value) >= 6 ? true : false;
        });

        Validator::extend('isNumber', function($attribute, $value, $parameters) {
            return $value != '' && $value >= 0 && ctype_digit((string)$value) ? true : false;
        });

        Validator::extend('isDwgFile', function($attribute, $value, $parameters) {
            $ext = $value->guessClientExtension();
            return $ext == 'dwg' ? true : false;
        },'The :attribute must be DWG file');

        Validator::extend('isCadFile', function($attribute, $value, $parameters) {
            $ext = strtolower($value->getClientOriginalExtension());
            if (in_array($ext, ['dwg', 'plt', 'dxf'])) {
                return true;
            } else {
                return false;
            }
        });

        Validator::extend('isChinaMobile', function ($attribute, $value, $parameters) {
            return isChinaMobile($value);
        });

        Validator::extend('isChinaMobileOrEmail', function ($attribute, $value, $parameters) {
            return isChinaMobile($value) || filter_var($value, FILTER_VALIDATE_EMAIL) === true;
        });

        Validator::extend('isGender', function ($attribute, $value, $parameters) {
            return in_array($value, [0, 1]);
        });

        view()->composer('frontend.layouts.default', function($view)
        {
//            app('session')->put('screeWidth', 1140);
            $screenWidth = app('session')->get('screenWidth');
            $bothSideMargin = '';
            if(isset($screenWidth)){
                if( $screenWidth > 1140 ){
                    $margin = ( $screenWidth - 1140) / 2;
                    $bothSideMargin = "margin-left: " . $margin . "px !important; margin-right: " . $margin . "px!important";
                }
            }

            $view->with('bothSideMargin', $bothSideMargin);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
