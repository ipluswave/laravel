<?php

namespace App\Models;

use Input;

class PermissionGroup extends BaseModels {
    protected $table = 'permission_groups';

    protected $fillable = [
        'group_name',
    ];

    protected $dates = ['deleted_at'];

    protected $rules = array(
        'group_name' => 'required|min:1|max:255',
    );

    public static function boot() {
        parent::boot();
    }

    public function permissions() {
        return $this->hasMany('App\Models\PermissionGroupPermission', 'permission_group_id', 'id');
    }

    public function scopeGetGroups($query) {
        return $query;
    }

    public function scopeGetFilteredResults($query) {
        if (Input::has('filter_row_id') && Input::get('filter_row_id') != '') {
            $query->where('id', '=', Input::get('filter_row_id'));
        }

        if (Input::has('filter_group_name') && Input::get('filter_group_name') != '') {
            $query->where('group_name', 'like', '%' . Input::get('filter_group_name') . '%');
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