<?php

namespace App\Models;

use Input;

class OrderConversation extends BaseModels {
    protected $table = 'order_conversation';

    protected $fillable = [
        ''
    ];

    public static function boot() {
        parent::boot();
    }

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }
	
	public function scopeGetOrderConversation($query) {
        return $query;
    }
}