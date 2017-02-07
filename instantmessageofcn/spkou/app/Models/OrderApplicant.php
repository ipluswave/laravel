<?php

namespace App\Models;

use Input;

class OrderApplicant extends BaseModels {

    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = 2;

    protected $table = 'order_applicants';

    protected $fillable = [
        ''
    ];

    public static function boot() {
        parent::boot();
    }

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
	
	function getOrderId() {
		return $this->order->order_id;
	}
	
	public function scopeGetOrderApplicant($query) {
        return $query;
    }
	
	public function scopeGetFilteredResults($query) {
        if (Input::has('filter_updated_after')) {
            $query->where('updated_at', '>=', Input::get('filter_updated_after'));
        }

        if (Input::has('filter_updated_before')) {
            $query->where('updated_at', '<=', Input::get('filter_updated_before'));
        }
    }
}