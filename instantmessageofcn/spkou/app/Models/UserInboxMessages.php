<?php

namespace App\Models;

use Input;

class UserInboxMessages extends BaseModels {

    const TYPE_ORDER_APPLICANT_SELECTED = 1;
    const TYPE_ORDER_NEW_MESSAGE = 2;
    const TYPE_ORDER_CONFIRMED_COMPLETED = 3;

    protected $table = 'users_inbox_messages';

    protected $fillable = [

    ];

    protected $dates = [];

    public static function boot() {
        parent::boot();
    }

    public function inbox() {
        return $this->belongsTo('App\Models\UserInbox', 'inbox_id', 'id');
    }

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id');
    }

    public function fromUser() {
        return $this->belongsTo('App\Models\User', 'from_user_id', 'id');
    }

    public function toUser() {
        return $this->belongsTo('App\Models\User', 'to_user_id', 'id');
    }

    public function isRead() {
        return $this->is_read == 1 ? true : false;
    }

    public function setTranslateVariableAttribute($value) {
        $this->attributes['translate_variable'] = json_encode($value);
    }

    public function getTranslateVariableAttribute($value) {
        return json_decode($this->attributes['translate_variable'], true);
    }

    public function getTitle() {
        switch ($this->type) {
            case static::TYPE_ORDER_APPLICANT_SELECTED:
                return trans('order.you_have_been_selected_for_order', ['orderId' => $this->order->order_id]);
                break;
            case static::TYPE_ORDER_NEW_MESSAGE:
                return trans('order.order_have_new_message', ['email' => $this->fromUser->email, 'name' => $this->fromUser->nick_name]);
                break;
            case static::TYPE_ORDER_CONFIRMED_COMPLETED:
                return trans('order.order_has_been_completed_by_creator', ['orderId' => $this->order->order_id]);
                break;
        }
    }

    public function getHtmlClass() {
        switch ($this->type) {
            case static::TYPE_ORDER_APPLICANT_SELECTED:
                return 'alert-info';
                break;
            case static::TYPE_ORDER_NEW_MESSAGE:
                return 'alert-success';
                break;
            case static::TYPE_ORDER_CONFIRMED_COMPLETED:
                return 'alert-warning';
                break;
            default:
                return 'alert-default';
                break;
        }
    }

    public function getGotoLink() {
        switch ($this->type) {
            case static::TYPE_ORDER_APPLICANT_SELECTED:
                if ($this->order_id != null) {
                    return route('frontend.mypublishorderdetails', $this->order_id);
                } else {
                    return 'javascript:;';
                }
                break;
            case static::TYPE_ORDER_NEW_MESSAGE:
                if ($this->order_id != null) {
                    return route('frontend.mypublishorderdetails', $this->order_id);
                } else {
                    return 'javascript:;';
                }
                break;
            case static::TYPE_ORDER_CONFIRMED_COMPLETED:
                if ($this->order_id != null) {
                    return route('frontend.mypublishorderdetails', $this->order_id);
                } else {
                    return 'javascript:;';
                }
                break;
            default:
                return 'javascript:;';
                break;
        }
    }

}