<?php

namespace App\Models;

use Input;

class UserLocation extends BaseModels {

    protected $table = 'users_locations';

    protected $fillable = [

    ];

    protected $dates = [];

    public static function boot() {
        parent::boot();
    }

    public function setApiResponseAttribute($value) {
        if (is_string($value)) {
            $this->attributes['api_response'] = $value;
        } else if (is_array($value)) {
            $this->attributes['api_response'] = json_encode($value);
        } else if (is_array(json_decode($value, true))) {
            $this->attributes['api_response'] = $value;
        } else {
            $this->attributes['api_response'] = $value;
        }
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function scopeGetLocations($query) {
        return $query;
    }

    public function scopeGetFilteredResults($query) {
        if (Input::has('filter_row_id') && Input::get('filter_row_id') != '') {
            $query->where('id', '=', Input::get('filter_row_id'));
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