<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
	protected $myOrderCount = null;
	protected $myJobCount = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
        'userscol', 'real_name', 'id_card_no',
        'gender', 'date_of_birth', 'address',
        'handphone_no', 'id_image_front', 'id_image_back'

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function province() {
		return $this->belongsTo('App\Models\Region', 'province_id', 'id');
	}

	public function city() {
		return $this->belongsTo('App\Models\Region', 'city_id', 'id');
	}

	public function area() {
		return $this->belongsTo('App\Models\Region', 'area_id', 'id');
	}

	public function verifications() {
		return $this->hasMany('App\Models\UserContactVerifications', 'user_id', 'id');
	}

    public function bankAccount() {
        return $this->hasMany('App\Models\UserBank', 'user_id', 'id');
    }
	
	public function identity() {
        return $this->hasMany('App\Models\UserIdentity', 'user_id', 'id');
    }
	
	public function tailor_request() {
        return $this->hasMany('App\Models\TailorRequest', 'user_id', 'id');
    }

    public function orders() {
        return $this->hasMany('App\Models\Order', 'creator_id', 'id')->orderBy('id', 'DESC');
    }

	public function skills() {
		return $this->hasMany('App\Models\UserSkill', 'user_id', 'id')->orderBy('id', 'ASC');
	}

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setEmailAttribute($value) {
        $this->attributes['email'] = trim(strtolower($value));
    }

    public function scopeGetUsers($query) {
        return $query;
    }

    public function scopeGetFilteredResults($query) {
        return $query;
    }

    public function getYearsOld() {
        if ($this->date_of_birth) {
            return \Carbon\Carbon::createFromFormat('Y-m-d', $this->date_of_birth)->diff(\Carbon\Carbon::now())->format('%y');
        } else {
            return '-';
        }
    }

	public function getRating() {
		$users = DB::table('order')
		            ->select(DB::raw('avg(order_applicants.rate_quality + order_applicants.rate_communicate + order_applicants.rate_speed) as rating'))
					->join('order_applicants', function($join)
		        	{
		            	$join->on('order.id', '=', 'order_applicants.order_id')
				                 ->where('order_applicants.user_id', '=', $this->id);
			        })
		            ->where('order_applicants.status', '=', 1)
		            ->first();
		return $users->rating;
	}
	
	public function getLevel() {
		$users = DB::table('order')
		            ->select(DB::raw('sum(order_applicants.rate_quality + order_applicants.rate_communicate + order_applicants.rate_speed) as point'))
					->join('order_applicants', function($join)
		        	{
		            	$join->on('order.id', '=', 'order_applicants.order_id')
				                 ->where('order_applicants.user_id', '=', $this->id);
			        })
		            ->where('order_applicants.status', '=', 1)
		            ->first();
		
		$level = DB::table('level')
		            ->select('badge')
		            ->where('level', '>=', (int) $users->point)
					->orderBy('level')
					->limit(1)
		            ->first();
		return $level->badge;
	}

	public function getMyOrderCount() {
		if ($this->myOrderCount == null) {
			$this->myOrderCount = Order::where('creator_id', '=', $this->id)->count();
		}

		return $this->myOrderCount;
	}

	public function getMyJobCount() {
		if ($this->myJobCount == null) {
			$this->myJobCount = OrderApplicant::where('user_id', '=', $this->id)->where('status', '=', OrderApplicant::STATUS_ACCEPTED)->count();
		}

		return $this->myJobCount;
	}

	public function setImgAvatarAttribute($file)
	{
		if ($file instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
			$img = \Image::make($file);
			$mime = $img->mime();
			$ext = convertMimeToExt($mime);

			$path = 'uploads/user/' . \Auth::guard('users')->user()->id . '/avatar/';
			$filename = generateRandomUniqueName();

			touchFolder($path);

			$img = $img->save($path . $filename . $ext, 90);

			$this->attributes['img_avatar'] = $path . $filename . $ext;
		}
	}

	public function getAvatar() {
		if ($this->img_avatar == '' || $this->img_avatar == null) {
			return asset('images/avatar.png');
		} else {
			return asset($this->img_avatar);
		}
	}

	public function myInbox() {
		return $this->hasMany('App\Models\UserInbox', 'to_user_id', 'id')->orderBy('id', 'DESC');
	}

	public static function checkAndSaveLocation() {
		if (\Auth::guard('users')->check()) {
			$user = \Auth::guard('users')->user();
            $ip = request()->getClientIp();
            if ($user->last_login_ip_address == null || $ip != $user->last_login_ip_address) {

                $api_url = 'http://ip.taobao.com/service/getIpInfo.php?ip=%s';

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => sprintf($api_url, $ip),
                ));
                // Send the request & save response to $resp
                $resp = curl_exec($curl);
                // Close request to clear up some resources
                curl_close($curl);

                if (is_array(json_decode($resp, true))) {
                    $resp = json_decode($resp, true);

                    //If the response no error
                    if (isset($resp['code']) && $resp['code'] == 0 && isset($resp['data'])) {
                        $data = $resp['data'];

                        $user->country = $data['country'] != '' ? $data['country'] : null;
                        $user->country_id = $data['country_id'] != '' ? $data['country_id'] : null;
                        $user->area = $data['area'] != '' ? $data['area'] : null;
                        $user->area_id = $data['area_id'] != '' ? $data['area_id'] : null;
                        $user->region = $data['region'] != '' ? $data['region'] : null;
                        $user->region_id = $data['region_id'] != '' ? $data['region_id'] : null;
                        $user->city = $data['city'] != '' ? $data['city'] : null;
                        $user->city_id = $data['city_id'] != '' ? $data['city_id'] : null;
                        $user->last_login_ip_address = $ip;

                        $loc = new UserLocation();
                        $loc->user_id = $user->id;
                        $loc->country = $data['country'] != '' ? $data['country'] : null;
                        $loc->country_id = $data['country_id'] != '' ? $data['country_id'] : null;
                        $loc->area = $data['area'] != '' ? $data['area'] : null;
                        $loc->area_id = $data['area_id'] != '' ? $data['area_id'] : null;
                        $loc->region = $data['region'] != '' ? $data['region'] : null;
                        $loc->region_id = $data['region_id'] != '' ? $data['region_id'] : null;
                        $loc->city = $data['city'] != '' ? $data['city'] : null;
                        $loc->city_id = $data['city_id'] != '' ? $data['city_id'] : null;
                        $loc->ip_address = $ip;
                        $loc->api_response = $resp;

                        try {
                            \DB::beginTransaction();
                            $user->save();
                            $loc->save();
                            \DB::commit();
                            return true;
                        } catch (\Exception $e) {
                            \DB::rollback();
                            return false;
                        }

                    }
                }
            }
		}
	}
}
