<?php

namespace App\Models;

use Input;

class OrderMaterial extends BaseModels {
    protected $table = 'order_material';

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