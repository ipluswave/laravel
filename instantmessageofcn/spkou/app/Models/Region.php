<?php

namespace App\Models;

use Input;

class Region extends BaseModels {
    protected $table = 'region';

    protected static $json = null;

    protected $fillable = [];

    protected $dates = [];

    public static function boot() {
        parent::boot();
    }

    public function children() {
        return $this->hasMany('App\Models\Region', 'parent_id', 'id');
    }

    public function scopeGetRegion($query) {
        return $query;
    }

    public function getName() {
        if (app()->getLocale() == 'cn') {
            return $this->region_name;
        } else {
            return $this->region_name_en;
        }
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