<?php

namespace App\Models;

use Input;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBank extends BaseModels {
    use SoftDeletes;

    protected $table = 'users_bank';

    protected $fillable = [
        'account_name', 'account_number', 'account_address',
    ];

    protected $dates = ['deleted_at'];

    public static function boot() {
        parent::boot();
    }

    public function bank() {
        return $this->belongsTo('App\Models\Bank', 'bank_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }

    public function getAccountNumberPart() {
        return substr($this->account_number, -4);
    }

}