<?php

namespace App\Models;

use Input;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModels {
    use SoftDeletes;

    protected static $categories = null;

    protected $table = 'category';

    protected $fillable = [
        'title_cn', 'title_en', 'selectable'
    ];

    protected $dates = ['deleted_at'];

    public static function boot() {
        parent::boot();
    }

    public function parent() {
        return $this->belongsTo('App\Models\Category', 'parent_id', 'id');
    }

    public function children() {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }

    public static function getCategories($level, $parent_id = null) {
        if ($level == 1) {
            $c = static::whereNull('parent_id')->where('level', '=', 1)->whereHas('children', function ($q){});
        } else {
            $c = static::where('level', '=', $level);
            if ($parent_id != null) {
                $c->where('parent_id', '=', $parent_id);
            }
        }
        return $c;
    }

    public static function getCategoriesArray() {
        $category_1 = static::whereNull('parent_id')->where('level', '=', 1)->get();
        $category_2 = static::whereNotNull('parent_id')->where('level', '=', 2)->get();
        $category_3 = static::whereNotNull('parent_id')->where('level', '=', 3)->get();

        if (static::$categories === null) {
            $c = array();
            $c['level_1'] = array();
            $c['level_2'] = array();
            $c['level_3'] = array();
            foreach ($category_1 as $key => $var) {
                $c['level_1'][$var->id] = array(
                    'id' => $var->id,
                    'name' => $var->getTitle()
                );
            }
            foreach ($category_2 as $key => $var) {
                $c['level_2'][$var->parent_id][$var->id] = array(
                    'id' => $var->id,
                    'name' => $var->getTitle(),
                    'parent_id' => $var->parent_id
                );
            }
            foreach ($category_3 as $key => $var) {
                $c['level_3'][$var->parent_id][$var->id] = array(
                    'id' => $var->id,
                    'name' => $var->getTitle(),
                    'parent_id' => $var->parent_id
                );
            }

            static::$categories = $c;
        }

        return static::$categories;
    }

    public function scopeGetCategory($query) {
        return $query;
    }

    public function getTitle() {
        $field = 'title_' . app()->getLocale();

        return $this->$field;
    }

    public function getTitles() {
        return $this->title_cn . ' / ' . $this->title_en;
    }

    public function scopeGetFilteredResults($query) {
        if (Input::has('filter_row_id') && Input::get('filter_row_id') != '') {
            $query->where('id', '=', Input::get('filter_row_id'));
        }

        if (Input::has('filter_title') && Input::get('filter_title') != '') {
            $query->where('title_cn', 'like', '%' . Input::get('filter_title') . '%')
                ->orWhere('title_en', 'like', '%' . Input::get('filter_title') . '%');
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
    }

}