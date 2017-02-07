<?php

namespace App\Models;

use Auth;
use Validator;
use Input;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Staff extends BaseModels implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    const STAFF_TYPE_ADMIN = 1;
    const STAFF_TYPE_STAFF = 2;

    protected static $userPermissions = null;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'staff';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public static function boot() {
        parent::boot();
    }

    public static function defaultUserType() {
        return static::STAFF_TYPE_STAFF;
    }

    public function getDefaultUserType() {
        return static::defaultUserType();
    }

    public function permissionGroup() {
        return $this->hasOne('App\Models\PermissionGroup', 'id', 'permission_group_id');
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setEmailAttribute($value) {
        $this->attributes['email'] = trim(strtolower($value));
    }

    public function setUsernameAttribute($value) {
        $this->attributes['username'] = trim(strtolower($value));
    }

    public function isAdmin() {
        return $this->staff_type == static::STAFF_TYPE_ADMIN;
    }

    public function isStaff() {
        return $this->staff_type == static::STAFF_TYPE_ADMIN || $this->staff_type == static::STAFF_TYPE_STAFF;
    }

    public function scopeGetStaff($query) {
        return $query->where('staff_type', '=', static::getDefaultUserType());
    }

    public function getPermissions() {
        if (static::$userPermissions === null && static::$userPermissions !== false) {
            $this->load(['permissionGroup', 'permissionGroup.permissions']);
            if ($this->permission_group_id != null && $this->permissionGroup) {
                $lists = PermissionGroupPermission::getPermissionsLists();
                $arr = array();

                foreach ($this->permissionGroup->permissions as $key => $var) {
                    if (isset($lists[$var->permission_tag])) {
                        $arr[$var->permission_tag] = $lists[$var->permission_tag];
                    } else {
                        $arr[$var->permission_tag] = sprintf('Unknown Permission %s', $var->permission_tag);
                    }
                }

                static::$userPermissions = $arr;
            } else {
                static::$userPermissions = false;
            }
        }

        return static::$userPermissions;
    }

    public function hasPermission($permission) {
        $permission = strtolower($permission);

        if ($this->isAdmin()) {
            return true;
        }

        if (!$this->isStaff()) {
            return false;
        }

        $my_permissions = $this->getPermissions();

        if ($my_permissions == false || $my_permissions == null) {
            return false;
        }

        if (isset($my_permissions[$permission])) {
            return true;
        }

        return false;
    }

    public function scopeGetFilteredResults($query) {
        if (Input::has('filter_row_id')) {
            $query->where('id', '=', Input::get('filter_row_id'));
        }

        if (Input::has('filter_username')) {
            $query->where('username', 'like', "%" . Input::get('filter_username') . "%");
        }

        if (Input::has('filter_name')) {
            $query->where('name', 'like', "%" . Input::get('filter_name') . "%");
        }

        if (Input::has('filter_email')) {
            $query->where('email', 'like', "%" . Input::get('filter_email') . "%");
        }

        if (Input::has('filter_group_name') && Input::get('filter_group_name') != '') {
            $query->whereHas('permissionGroup', function ($q) {
                $q->where('group_name', 'like', '%' . Input::get('filter_group_name') . '%');
            });
        }

        if (Input::has('filter_created_after')) {
            $query->where('created_at', '>=', Input::get('filter_created_after'));
        }

        if (Input::has('filter_created_before')) {
            $query->where('created_at', '<=', Input::get('filter_created_before'));
        }

        if (Input::has('filter_updated_after')) {
            $query->where('updated_at', '>=', Input::get('filter_updated_after'));
        }

        if (Input::has('filter_updated_before')) {
            $query->where('updated_at', '<=', Input::get('filter_updated_before'));
        }

        if (Input::has('filter_status')) {
            if (Input::get('filter_status') == 1) {
                $query->where('deleted_at', '=', NULL);
            } else if (Input::get('filter_status') == 2) {
                $query->whereNotNull('deleted_at');
            }
        }

        return $query;
    }
}
