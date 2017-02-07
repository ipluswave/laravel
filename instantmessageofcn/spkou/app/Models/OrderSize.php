<?php

namespace App\Models;

use Input;

class OrderSize extends BaseModels {
    protected $table = 'order_size';

    protected $fillable = [
        ''
    ];

    public static function boot() {
        parent::boot();
    }
}