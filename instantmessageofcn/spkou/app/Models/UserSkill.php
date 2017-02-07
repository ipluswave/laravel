<?php

namespace App\Models;

use Input;

class UserSkill extends BaseModels {

    protected $table = 'user_skill';

    protected $fillable = [

    ];

    protected $dates = [];

    public static function boot() {
        parent::boot();
    }

    public function user() {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

}