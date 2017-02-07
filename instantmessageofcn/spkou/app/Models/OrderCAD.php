<?php

namespace App\Models;

use Input;

class OrderCAD extends BaseModels {
    protected $table = 'order_cad';

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