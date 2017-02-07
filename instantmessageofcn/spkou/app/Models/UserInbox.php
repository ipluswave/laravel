<?php

namespace App\Models;

use Input;

class UserInbox extends BaseModels {

    const TYPE_ORDER_APPLICANT_SELECTED = 1;
    const TYPE_ORDER_NEW_MESSAGE = 2;
    const TYPE_ORDER_CONFIRMED_COMPLETED = 3;

    protected $latestMessage = null;

    protected $table = 'users_inbox';

    protected $fillable = [

    ];

    protected $dates = [];

    public static function boot() {
        parent::boot();
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

    public function messages() {
        return $this->hasMany('App\Models\UserInboxMessages', 'inbox_id', 'id')->orderBy('updated_at', 'DESC');
    }

    public function getTitle() {
        return $this->getLatestMessage()->getTitle();
//        switch ($this->type) {
//            case static::TYPE_ORDER_APPLICANT_SELECTED:
//                return trans('order.you_have_been_selected_for_order', ['orderId' => $this->order->order_id]);
//            break;
//            case static::TYPE_ORDER_NEW_MESSAGE:
//                return trans('order.order_have_new_message', ['email' => $this->fromUser->email, 'name' => $this->fromUser->nick_name]);
//            break;
//            case static::TYPE_ORDER_CONFIRMED_COMPLETED:
//                return trans('order.order_has_been_completed_by_creator', ['orderId' => $this->order->order_id]);
//            break;
//        }
    }

    public function getHtmlClass() {
        switch ($this->type) {
            case static::TYPE_ORDER_APPLICANT_SELECTED:
                return 'panel-info';
                break;
            case static::TYPE_ORDER_NEW_MESSAGE:
                return 'panel-success';
                break;
            case static::TYPE_ORDER_CONFIRMED_COMPLETED:
                return 'panel-warning';
                break;
            default:
                return 'panel-default';
                break;
        }
    }

    private function getLatestMessage() {
        if ($this->latestMessage == null) {
            $this->latestMessage = UserInboxMessages::where('inbox_id', '=', $this->id)->orderBy('updated_at', 'DESC')->first();
        }

        return $this->latestMessage;
    }

}