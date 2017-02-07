<?php

namespace App\Models;

use Input;

class Order extends BaseModels {

    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_HIRED = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELLED = 4;

    protected $table = 'order';

    protected $fillable = [
        ''
    ];

    public static function boot() {
        parent::boot();
    }

    public function creator() {
        return $this->belongsTo('App\Models\User', 'creator_id', 'id');
    }

    public function payments() {
        return $this->hasMany('App\Models\OrderPayment', 'order_id', 'id');
    }

    public function logs() {
        return $this->hasMany('App\Models\OrderLog', 'order_id', 'id');
    }

    public function sizes() {
        return $this->hasMany('App\Models\OrderSize', 'order_id', 'id');
    }

    public function materials() {
        return $this->hasMany('App\Models\OrderMaterial', 'order_id', 'id');
    }

    public function processingGuides() {
        return $this->hasMany('App\Models\OrderProcessingGuide', 'order_id', 'id');
    }

    public function cads() {
        return $this->hasMany('App\Models\OrderCAD', 'order_id', 'id');
    }

    public function conversations() {
        return $this->hasMany('App\Models\OrderConversation', 'order_id', 'id');
    }

    public function properties() {
        return $this->hasMany('App\Models\OrderProperty', 'order_id', 'id');
    }

    public function applicants() {
        return $this->hasMany('App\Models\OrderApplicant', 'order_id', 'id');
    }

    public function tailor() {
        return $this->hasOne('App\Models\OrderApplicant', 'order_id', 'id')->where('status', '=', OrderApplicant::STATUS_ACCEPTED);
    }

    public function style() {
        return $this->belongsTo('App\Models\Category', 'style_id', 'id');
    }

    public function topBottom() {
        return $this->belongsTo('App\Models\Category', 'top_bottom_id', 'id');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function orderInbox() {
        return $this->hasOne('App\Models\UserInbox', 'order_id', 'id');
    }

    public function getMaterialsString() {
        $arr = array();
        foreach ($this->materials as $key => $var) {
            $arr[] = $var->percent . '% ' . $var->material_name;
        }

        return implode(',', $arr);
    }

    public function getMaterialsString2() {
        $arr = array();
        foreach ($this->materials as $key => $var) {
            $arr[] = $key + 1 . ',' . $var->material_name . ',' .$var->percent ;
        }

        return implode('|', $arr);
    }

    public function getPlannedDate() {
        $datetime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->planned_date);

        $string = $datetime->format('d F Y - H:i');
        
        switch (app()->getLocale()) {
            case 'cn': return convertENDateTimePicker($string); break;
            default: return $string; break;
        }

    }

    public function explainMaterial() {
        return \App\Constants::translateMaterial($this->material);
    }

    public function explainBodyShape() {
        return \App\Constants::translateBodyShape($this->body_shape);
    }

    public function scopeJoinAppliedCheck($query) {
        if (\Auth::guard('users')->check()) {
            $query->select('order.*', \DB::raw('order_applicants.id AS applicant_id, order_applicants.status AS applicant_status, order_applicants.user_id AS applicant_user_id'))
                ->leftJoin('order_applicants', function ($join) {
                $join->on('order_applicants.order_id', '=', 'order.id')
                    ->where('user_id', '=', \Auth::guard('users')->user()->id);
            });
        }
    }

    public function scopeJoinApprovedApplicant($query) {
        $query->select('order.*', \DB::raw('order_applicants.id AS applicant_id, order_applicants.status AS applicant_status, order_applicants.user_id AS applicant_user_id'))
            ->leftJoin('order_applicants', function ($join) {
                $join->on('order_applicants.order_id', '=', 'order.id')
                    ->where('order_applicants.status', '=', OrderApplicant::STATUS_ACCEPTED);
            });
    }

    public function isVerified() {
        return $this->is_validated == 1 ? true : false;
    }

    public function haveApprovedApplicant() {
        foreach ($this->applicants as $key => $var) {
            if ($var->status == OrderApplicant::STATUS_ACCEPTED) {
                return true;
            }
        }

        return false;
    }

    public function explainSealWidth() {
        if ($this->seal_width == 1) {
            $arr = array();
            if ($this->cseaommon_seal == 1) {
                $arr[] = trans('order.common_seal') . ' ' . $this->common_seal_num . 'cm';
            }
            if ($this->seal3 == 1) {
                $arr[] = trans('order.seal_3') . ' ' . $this->seal_3_num . 'cm';
            }
            if ($this->seal2 == 1) {
                $arr[] = trans('order.seal_2') . ' ' . $this->seal_2_num . 'cm';
            }
            if ($this->seal1 == 1) {
                $arr[] = trans('order.seal_1') . ' ' . $this->seal_1_num . 'cm';
            }
            if ($this->niddle_size == 1) {
                $arr[] = trans('order.niddle_size') . ' ' . $this->niddle_size_num . 'cm';
            }

            if ($this->include_seal == 1) {
                if ($this->	front_big_back_small == 1) {
                    $arr[] = trans('order.front_big_back') . ' ' . $this->include_seal_num_1;
                } else if ($this->front_small_back_big == 1) {
                    $arr[] = trans('order.front_small_back') . ' ' . $this->include_seal_num_1;
                }
            }
            return implode(', ', $arr);
        } else {
            return null;
        }
    }

    public function explainDecreaseRate() {
        $arr = array();
        if ($this->decrease_rate == 1) {
            if ($this->parar != 0) {
                $arr[] = trans('order.pararal') . $this->parar . '%';
            }
            if ($this->horiz != 0) {
                $arr[] = trans('order.horizontal') . $this->horiz . '%';
            }
            return implode(', ', $arr);
        } else {
            return null;
        }
    }

    public function explainStatus() {
        switch ($this->status) {
            case 0: return trans('order.draft'); break;
            case 1: return trans('order.pending'); break;
            case 2: return trans('order.progressing'); break;
            case 3: return trans('order.completed'); break;
            case 4: return trans('order.cancelled'); break;
            default: return trans('common.unknown'); break;
        }
    }

    public function explainTailorStatus() {
        switch ($this->status) {
            case 0: return trans('order.draft'); break;
            case 1: return trans('member.apply'); break;
            case 2: return trans('order.progressing'); break;
            case 3: return trans('order.completed'); break;
            case 4: return trans('order.cancelled'); break;
            default: return trans('common.unknown'); break;
        }
    }

    public function explainRawMaterials() {
        if ($this->materials) {
            $arr = array();
            foreach ($this->materials as $key => $var) {
                $arr[] = $var->material_name . ' ' . $var->percent . '%';
            }

            return implode(', ', $arr);
        } else {
            return null;
        }
    }

    public function setFrontPatternImageAttribute($file)
    {
        if ($file instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
            $img = \Image::make($file);
            $mime = $img->mime();
            $ext = convertMimeToExt($mime);

            $c = new \Carbon\Carbon();
            $path = 'uploads/order/' . \Auth::guard('users')->user()->id . '/cover/' . $c->format('Y/m/');
            $filename = 'front_' . generateRandomUniqueName();

            touchFolder($path);

            $img = $img->save($path . $filename . $ext, 90);

            $this->attributes['front_pattern_image'] = $path . $filename . $ext;
        }
    }

    public function setBackPatternImageAttribute($file)
    {
        if ($file instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
            $img = \Image::make($file);
            $mime = $img->mime();
            $ext = convertMimeToExt($mime);

            $c = new \Carbon\Carbon();
            $path = 'uploads/order/' . \Auth::guard('users')->user()->id . '/cover/' . $c->format('Y/m/');
            $filename = 'back_' . generateRandomUniqueName();

            touchFolder($path);

            $img = $img->save($path . $filename . $ext, 90);

            $this->attributes['back_pattern_image'] = $path . $filename . $ext;
        }
    }

    public function createOrderId() {
        if ($this->id) {
            $prefix = 'NGC';
            $date = $this->created_at->format('Ym');
            $id = str_pad($this->id, 6, '0', STR_PAD_LEFT);
            return $prefix . $date . $id;
        } else {
            return false;
        }
    }
	
	public function getCreator() {
		return $this->creator->email;
	}
	
	public function scopeGetFilteredResults($query) {
        if (Input::has('filter_name') && Input::get('filter_name') != '') {
            $query
            	->join('users', function($join)
		        {
		            $join->on('users.id', '=', 'order.creator_id')
		                 ->where('users.email', 'like', '%' . Input::get('filter_email') . '%');
		        });
        }
        if (Input::has('filter_status') && Input::get('filter_status') != '') {
            $query->where('status', '=', Input::get('filter_status'));
        }
		if (Input::has('filter_created_after')) {
            $query->where('created_at', '>=', Input::get('filter_created_after'));
        }

        if (Input::has('filter_created_before')) {
            $query->where('created_at', '<=', Input::get('filter_created_before'));
        }
    }
	
	public function getStatusText() {
		switch ($this->status) {
			case $this->STATUS_DRAFT:
				return 'draft';
			case $this->STATUS_PUBLISHED:
				return 'published';
			case $this->STATUS_HIRED:
				return 'hired';
			case $this->STATUS_COMPLETED:
				return 'completed';
			case $this->STATUS_CANCELLED:
				return 'cancelled';
			default:
				return '';
		}
	}
	
	public function scopeGetOrder($query) {
        return $query;
    }
	
	public function getPaymentMethod() {
		switch ($this->status) {
			case 0:
				return 'alipay';
			case 1:
				return 'wechat';
			case 2:
				return 'paypal';
			default:
				return '';
		}
	}
}