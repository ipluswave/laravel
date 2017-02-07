<?php

namespace App\Models;

use Input;

class PermissionGroupPermission extends BaseModels {
    protected $table = 'permission_groups_permissions';

    protected $fillable = [
        'permission_tag'
    ];

    protected $dates = ['deleted_at'];

    protected $rules = array(
        'permission_group_id' => 'required|exists:operator_groups,id',
        'permission_tag' => 'required|isPermissionTag',
    );

    public static function boot() {
        parent::boot();
    }

    public function permissionGroup() {
        return $this->belongsTo('App\Models\PermissionGroup', 'permission_group_id', 'id');
    }

    public function setPermissionTagAttribute($value) {
        $this->attributes['permission_tag'] = strtolower($value);
    }

    //All the permissions for backend should set at here
    public static function getPermissionsLists() {
        $arr = array();

        $arr['manage_site_setting'] = '站点设置';
        $arr['manage_staff'] = '操作员管理';
        $arr['manage_user'] = '会员管理';
        $arr['manage_permission_groups'] = '权限组管理';
        $arr['manage_category'] = '目录管理';
        $arr['manage_bank'] = '银行管理';
        $arr['manage_raw_material'] = '原材料管理';

        return $arr;
    }

    public static function isValidPermission($permission_tag) {
        $permission_tag = strtolower($permission_tag);

        if (array_key_exists($permission_tag, static::getPermissionsLists())) {
            return true;
        } else {
            return false;
        }
    }

}