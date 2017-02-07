<?php

namespace App\Models;

use Input;

class Level extends BaseModels {
    protected $table = 'level';
	
	public $timestamps = false;

    protected $fillable = [
    ];
	
    public static function boot() {
        parent::boot();
    }

    public function scopeGetLevel($query) {
        return $query;
    }
	public function getIcons() {
        return "<img src='/$this->url_icon' alt='Icon' height='16' width='16'>";
    }
}
