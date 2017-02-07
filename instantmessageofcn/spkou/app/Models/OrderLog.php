<?php

namespace App\Models;

use Input;

class OrderLog extends BaseModels {
    protected $table = 'order_logs';

    protected $fillable = [
        ''
    ];

    public static function boot() {
        parent::boot();
    }

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }
}