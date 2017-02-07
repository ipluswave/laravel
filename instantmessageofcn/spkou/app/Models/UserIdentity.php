<?php

namespace App\Models;

use Input;

class UserIdentity extends BaseModels {

	const STATUS_PENDING = 0;
	const STATUS_APPROVED = 1;
	const STATUS_REJECTED = 2;

    protected $table = 'user_identity';

    protected $fillable = [
    ];

    public static function boot() {
        parent::boot();
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
	
	/**
	 * get user's gender
	 */
	function getGenderText() {
		if ($this->gender === 0) {
			return trans('member.male');
		} else if ($this->gender === 1) {
			return trans('member.female');
		} else {
			return "Invalid gender";
		}
	}
	
	function getOwnerEmail() {
		return $this->user->email;
	}
	
	public function scopeGetFilteredResults($query) {
        if (Input::has('filter_email') && Input::get('filter_email') != '') {
            $query
            	->join('users', function($join)
		        {
		            $join->on('users.id', '=', 'user_identity.user_id')
		                 ->where('users.email', 'like', '%' . Input::get('filter_email') . '%');
		        });
        }
    }

	public function getIdImageFront() {
		if ($this->id_image_front != null && $this->id_image_front != '') {
			return asset($this->id_image_front);
		} else {
			return null;
		}
	}

	public function setIdImageFrontAttribute($file)
	{
		if ($file instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
			$img = \Image::make($file);
			$mime = $img->mime();
			$ext = convertMimeToExt($mime);

			$path = 'uploads/user/' . \Auth::guard('users')->user()->id . '/identity/';
			$filename = generateRandomUniqueName();

			touchFolder($path);

			$img = $img->save($path . $filename . $ext);

			$this->attributes['id_image_front'] = $path . $filename . $ext;
		}
	}

	public function setIdImageBackAttribute($file)
	{
		if ($file instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
			$img = \Image::make($file);
			$mime = $img->mime();
			$ext = convertMimeToExt($mime);

			$path = 'uploads/user/' . \Auth::guard('users')->user()->id . '/identity/';
			$filename = generateRandomUniqueName();

			touchFolder($path);

			$img = $img->save($path . $filename . $ext);

			$this->attributes['id_image_back'] = $path . $filename . $ext;
		}
	}

	public function getIdImageBack() {
		if ($this->id_image_back != null && $this->id_image_back != '') {
			return asset($this->id_image_back);
		} else {
			return null;
		}
	}

	public function isPending() {
		return $this->status == static::STATUS_PENDING ? true : false;
	}

	public function isApproved() {
		return $this->status == static::STATUS_APPROVED ? true : false;
	}

	public function isRejected() {
		return $this->status == static::STATUS_REJECTED ? true : false;
	}
}
