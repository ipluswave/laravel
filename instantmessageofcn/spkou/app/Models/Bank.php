<?php

namespace App\Models;

use Input;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends BaseModels {
    use SoftDeletes;

    protected $table = 'bank';

    protected static $bankLists = null;

    protected $fillable = [
        'name_cn', 'name_en', 'logo', 'background_color', 'font_color'
    ];

    protected $dates = ['deleted_at'];

    public static function boot() {
        parent::boot();
    }

    public function getName() {
        $field = 'name_' . app()->getLocale();

        return $this->$field;
    }

    public function getNames() {
        return $this->name_cn . ' / ' . $this->name_en;
    }

    public function setLogoAttribute($file)
    {
        if ($file instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
            $img = \Image::make($file);
            $mime = $img->mime();
            $ext = convertMimeToExt($mime);

            $path = 'uploads/bank/logo/';
            $filename = generateRandomUniqueName();

            touchFolder($path);

            $img = $img->fit(65, 63)->save($path . $filename . $ext);

            $this->attributes['logo'] = $path . $filename . $ext;
        }
    }

    public function account() {
        return $this->hasMany('App\Models\UserBank', 'bank_id', 'id');
    }

    public function scopeGetBank($query) {
        return $query;
    }

    public static function getBankLists() {
        if (static::$bankLists === null) {
            $banks = static::GetBank();

            $lists = array();
            foreach ($banks->get() as $key => $var) {
                $lists[$var->id] = $var->getName();
            }
            static::$bankLists = $lists;
        }

        return static::$bankLists;
    }

    public function scopeGetFilteredResults($query) {
        if (Input::has('filter_row_id') && Input::get('filter_row_id') != '') {
            $query->where('id', '=', Input::get('filter_row_id'));
        }

        if (Input::has('filter_name') && Input::get('filter_name') != '') {
            $query->where('name_cn', 'like', '%' . Input::get('filter_name') . '%')
                ->orWhere('name_en', 'like', '%' . Input::get('filter_name') . '%');
        }

        if (Input::has('filter_created_after')) {
            $query->where('created_at', '>=', Input::get('filter_created_after'));
        }

        if (Input::has('filter_created_before')) {
            $query->where('created_at', '<=', Input::get('filter_created_before'));
        }

        if (Input::has('filter_updated_after')) {
            $query->where('updated_at', '>=', Input::get('filter_updated_after'));
        }

        if (Input::has('filter_updated_before')) {
            $query->where('updated_at', '<=', Input::get('filter_updated_before'));
        }
    }

}