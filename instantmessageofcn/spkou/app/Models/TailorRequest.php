<?php

namespace App\Models;

use Input;

class TailorRequest extends BaseModels {
    protected $table = 'tailor_request';

    protected $fillable = [
    ];

    public static function boot() {
        parent::boot();
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
	
	function getOwnerEmail() {
		return $this->user->email;
	}
	
	public function scopeGetFilteredResults($query) {
        if (Input::has('filter_email') && Input::get('filter_email') != '') {
            $query
            	->join('users', function($join)
		        {
		            $join->on('users.id', '=', 'tailor_request.user_id')
		                 ->where('users.email', 'like', '%' . Input::get('filter_email') . '%');
		        });
        }
    }
}
