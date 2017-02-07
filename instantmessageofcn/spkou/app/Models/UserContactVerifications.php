<?php

namespace App\Models;

use Input;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserContactVerifications extends BaseModels {

    const STATUS_UNUSED = 0;
    const STATUS_USED = 1;

    protected $table = 'users_contact_verifications';

    protected $fillable = [

    ];

    protected $dates = [];

    public static function boot() {
        parent::boot();
    }

    public function user() {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }

    public function setParamsAttribute($value) {
        if (is_string($value)) {
            $this->attributes['params'] = $value;
        } else if (is_array($value)) {
            $this->attributes['params'] = json_encode($value);
        } else if (is_array(json_decode($value, true))) {
            $this->attributes['params'] = $value;
        } else {
            $this->attributes['params'] = $value;
        }
    }

}