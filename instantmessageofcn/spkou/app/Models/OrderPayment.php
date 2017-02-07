<?php

namespace App\Models;

use Input;

class OrderPayment extends BaseModels {

    const STATUS_PENDING = 0;
    const STATUS_SUCCESSFULLY = 1;
    const STATUS_REFUNDED = 2;

    const PAYMENT_METHOD_ALIPAY = 1;
    const PAYMENT_METHOD_WECHAT = 2;
    const PAYMENT_METHOD_PAYPAL = 3;

    protected $table = 'order_payment';

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

    public function explainStatus() {
        switch ($this->status) {
            case static::STATUS_PENDING: return trans('order.payment_pending'); break;
            case static::STATUS_SUCCESSFULLY: return trans('order.payment_successfully'); break;
            case static::STATUS_REFUNDED: return trans('order.payment_pending'); break;
            default: return trans('common.unknown'); break;
        }
    }
	
	public function scopeGetFilteredResults($query) {
        if (Input::has('filter_name') && Input::get('filter_name') != '') {
            $query
            	->join('users', function($join)
		        {
		            $join->on('users.id', '=', 'order.creator_id')
		                 ->where('users.email', 'like', '%' . Input::get('filter_email') . '%');
		        });
        }
        if (Input::has('filter_status') && Input::get('filter_status') != '') {
            $query->where('status', '=', Input::get('filter_status'));
        }
		if (Input::has('filter_created_after')) {
            $query->where('created_at', '>=', Input::get('filter_created_after'));
        }

        if (Input::has('filter_created_before')) {
            $query->where('created_at', '<=', Input::get('filter_created_before'));
        }
    }
	
	public function scopeGetPament($query) {
        return $query;
    }
	
	public function getPaymentMethod() {
		switch ($this->status) {
			case 1:
				return 'alipay';
			case 2:
				return 'wechat';
			case 3:
				return 'paypal';
			default:
				return 'Unknown';
		}
	}
}