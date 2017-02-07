<?php

namespace App\Models;

use Input;

class OrderProperty extends BaseModels {
    protected $table = 'order_property';

    protected $fillable = [
        ''
    ];

    public static function boot() {
        parent::boot();
    }

    public function log() {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }
}